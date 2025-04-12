<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Datatable\Admin\CategoryDatatable;

class CategoryController extends Controller
{
    protected $model = "Categories";
    protected $icon = 'bi bi-list-task';
    public function index()
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Index";
        return view('admin.categories.index', compact('model', 'icon', 'label'));
    }

    public function getCategories()
    {
        $searchTerm = request()->get('search')['value'];
        $categories = Category::query();
        if(!empty($searchTerm)){
            $categories = $categories->where('title', 'LIKE', "%{$searchTerm}%");
        }
        $categories = $categories->with(['parentCategory'])
       ->orderBy('created_at','desc')->get();
        return DataTables::of($categories)
            ->addColumn('image', function (Category $category) {
                $image = get_category_image($category->image);
                return '<img src="' . $image . '" width="100" height="100">';
            })
            ->addColumn('parent_category', function (Category $category) {
               return $category->parentCategory ? $category->parentCategory->title : "";
            })
            ->addColumn('action', function ($category) {
                //  <a class="btn-icon text-warning"  data-toggle="tooltip" data-placement="top" title="View" href="'.route('admin.categories.view',$category->id) .'"><i class="bi bi-eye"></i></a>
                return '
                    <a class="btn-icon text-info"  data-toggle="tooltip" data-placement="top" title="Edit" href="'.route('admin.categories.edit',$category->id) .'"><i class="bi bi-pencil"></i></a>
                    <a class="btn-icon text-danger"  data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteItem(' . $category->id . ')"><i class="bi bi-trash"></i></a>';
            })
            ->rawColumns(['image', 'parent_category', 'action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function create()
    {
        $categoryCount = Category::count();
        $sortorder = $categoryCount + 1;

        $model = $this->model;
        $icon = $this->icon;
        $label = "Create";

        $categories = $this->getCategorySchema()->get();
        return view('admin.categories.create', compact('categories', 'model', 'icon', 'sortorder', 'label'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100|regex:/^[\pL\s\-]+$/u',

            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $imageDirectoryPath = 'categories';
            $imagePath = $image->storeAs($imageDirectoryPath, $filename, 'public');
        }

        $status = request()->get('status') == null ? 0 : request()->get('status');
        $sortOrder = request()->get('sort_order') == null ? 0 : request()->get('sort_order');
        if ($sortOrder === null || !is_numeric($sortOrder) || $sortOrder <= 0) {
            return redirect()->back()->withInput()->with('error', 'Invalid sort order. Please provide a positive integer.');
        }
        $adminId = Auth()->guard('admin')->id();
        $title = $request->title;
        $category = [
            'admin_id' => $adminId,
            'category_id' => $request->category_id,
            'title' => $title,
            'slug' => generate_unique_slug($title, Category::class),
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $status,
            'display_on_home' => $request->display_on_home ? $request->display_on_home : 0,
            'sort_order' => $sortOrder,
        ];

        Category::create($category);
        return redirect()->route('admin.categories.index');
    }



    public function destroy($id)
    {
        $item = Category::find($id);
        if ($item) {
            $item->delete();
            return response()->json(['success' => true, 'message' => 'Category deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Category not found.']);
    }
    public function edit($id)
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Edit";
        $categories = $this->getCategorySchema($id)->get();
        $category = Category::find($id);

        return view('admin.categories.edit', compact('categories', 'category', 'model', 'icon', 'label'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100|regex:/^[\pL\s\-]+$/u',

            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $categories = Category::find($id);
        $category_id = request()->get('category_id');
        if ($category_id == 0) {
            $category_id = null;
        }

        $categories->category_id = $category_id;

        $categories->title = request()->get('title');
        $categories->description = request()->get('description');
        $categories->status = request()->get('status');
        $categories->display_on_home = request()->get('display_on_home') ? 1 : 0;
        $sortOrder = request()->get('sort_order') == null ? 0 : request()->get('sort_order');
        $categories->sort_order = $sortOrder;
        $sortOrder = request()->get('sort_order') == null ? 0 : request()->get('sort_order');
        if ($sortOrder === null || !is_numeric($sortOrder) || $sortOrder <= 0) {
            // Redirect back with an error message and old input
            return redirect()->back()->withInput()->with('error', 'Invalid sort order. Please provide a positive integer.');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $imageDirectoryPath = 'categories';
            $imagePath = $image->storeAs($imageDirectoryPath, $filename, 'public');
            $categories->image = $imagePath;
        }

        $categories->update();
        return redirect()->route('admin.categories.index');
    }

    public function view($id)
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "View";

        $category = Category::with(['parentCategory:id,category_id,title'])->find($id);

        return view('admin.categories.view', compact('category', 'model', 'icon', 'label'));
    }



    protected function getCategorySchema($id = null)
    {
        $categoryBuilder = Category::where('status', 1);
        if(!empty($id)){
            $categoryBuilder = $categoryBuilder->where('id', '!=', $id);
        }
        return $categoryBuilder;
    }
}
