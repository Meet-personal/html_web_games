<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    protected $model = "Banner";
    protected $icon = 'bi bi-box-seam';
    public function index()
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Index";
        return view('admin.banners.index', compact('model', 'icon', 'label'));
    }


    public function getBanners()
    {
        $banners = Banner::with([
            'category' => function ($query) {
                $query->select('id', 'title');
            },
            'game' => function ($query) {
                $query->select('id', 'name');
            }
        ])
        ->orderBy('created_at','desc')->get();

        return DataTables::of($banners)
            ->addColumn('category_id', function ($banner) {
                // Retrieve the category title
                return $banner->category ? $banner->category->title : "";
            })
            ->addColumn('game_id', function ($banner) {
                // Retrieve the game name
                return $banner->game ? $banner->game->name : "";
            })
            ->addColumn('type', function ($banner) {
                // Return the type
                return $banner->type;
            })
            ->addColumn('title', function ($banner) {
                // Return the title
                return $banner->title;
            })
            ->addColumn('description', function ($banner) {
                // Return the description
                return $banner->description;
            })
            ->addColumn('image', function ($banner) {
                // Generate the image HTML
                $image = common_image($banner->image);
                return '<img src="' . htmlspecialchars($image, ENT_QUOTES, 'UTF-8') . '" width="100" height="100">';
            })
            ->addColumn('status', function ($banner) {
                // Return the status
                return $banner->status ? "Active" : "Inactive";
            })
            ->addColumn('sort_order', function ($banner) {
                // Return the sort order
                return $banner->sort_order;
            })
            ->addColumn('action', function ($banner) {
                // Generate action buttons
                return '<a class="btn-icon text-info" data-toggle="tooltip" data-placement="top" title="Edit" href="#" onclick="editItem(' . $banner->id . ')"><i class="bi bi-pencil"></i></a>
                        <a class="btn-icon text-danger mb-1"data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteItem(' . $banner->id . ')"><i class="bi bi-trash"></i></a>';
            })
            ->rawColumns(['image', 'action']) // Specify columns containing HTML
            ->addIndexColumn()
            ->make(true);
    }


    public function create()
    {

        $model = $this->model;
        $icon = $this->icon;
        $label = "Create";
        $bannercount = Banner::count();

        $sortorder = $bannercount + 1;


        $categories = $this->getCategorySchema()->get();
        $games = $this->getGamechema()->get();
        return view('admin.banners.create', compact('categories', 'games', 'sortorder', 'model', 'icon', 'label'));
    }


    public function store(Request $request)
    {
        $request->validate([

            'type' => 'nullable|string|max:255',
            'title' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'description' => 'required|string|regex:/^[\pL\s\-]+$/u',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:0,1',
            'type' => 'required',
             'url' => 'nullable|url|unique:banners,url',
        ]);

        // $type = $validate['type'] ?? '0';
        $sortOrder  = request()->get('sort_order') == null ? 0 : request()->get('sort_order');
        if ($sortOrder === null || !is_numeric($sortOrder) || $sortOrder <= 0) {
            return redirect()->back()->withInput()->with('error', 'Invalid sort order. Please provide a positive integer.');
        }


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $imageDirectoryPath = 'banners';
            $imagePath = $image->storeAs($imageDirectoryPath, $filename, 'public');
        }
        $adminId = auth()->guard('admin')->id();
        $status  = request('status') == null ? 1 : request('status');
        $categoryId = $request->category_id;
        $gameId = $request->game_id;
        if (empty($categoryId)) {
            $categoryId = null;
        }
        if (empty($gameId)) {
            $gameId = null;
        }
        $banner = [
            'admin_id' => $adminId,
            'category_id' => $categoryId,
            'game_id' => $gameId,
            'type' =>    $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath ?? null,
            'status' => $status,
            'sort_order' =>   $sortOrder,
            'url' => $request->url,
        ];

        Banner::create($banner);
        return redirect()->route('admin.banners.index');
    }



    public function destroy($id)
    {
        $item = Banner::find($id);
        if ($item) {
            $item->delete();
            return response()->json(['success' => true, 'message' => 'Banner deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Banner not found.']);
    }
    public function edit($id)
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Edit";
        $categories = $this->getCategorySchema()->get();
        $games = $this->getGamechema()->get();
        $banners = Banner::find($id);
        return view('admin.banners.edit', compact('banners', 'categories', 'games', 'model', 'icon', 'label'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'type' => 'required|string|max:255',
            'title' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'description' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:0,1',
            'url' => 'nullable|url|unique:banners,url,' . $id,
    ]);

        $banners = Banner::find($id);
        $banners->category_id = $request->input('category_id');
        $banners->game_id = $request->input('game_id');
        $banners->type = $request->input('type');
        $banners->title = $request->input('title');
        $banners->description = $request->input('description');
        $file = $request->file('image');

        $banners->status = $request->input('status');
        $banners->url=$request->input('url');

        $sortOrder = request()->get('sort_order') == null ? 0 : request()->get('sort_order');
        $banners->sort_order = $sortOrder;
        $sortOrder = request()->get('sort_order') == null ? 0 : request()->get('sort_order');
        if ($sortOrder === null || !is_numeric($sortOrder) || $sortOrder <= 0) {
            // Redirect back with an error message and old input
            return redirect()->back()->withInput()->with('error', 'Invalid sort order. Please provide a positive integer.');
        }


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $imageDirectoryPath = 'banners';
            $imagePath = $image->storeAs($imageDirectoryPath, $filename, 'public');
            $banners->image = $imagePath;
        }

        $banners->update();

        return redirect()->route('admin.banners.index');
    }



    protected function getCategorySchema()
    {
        return Category::where('status', 1);
    }

    protected function getGamechema()
    {
        return Game::where('status', 1);
    }
}
