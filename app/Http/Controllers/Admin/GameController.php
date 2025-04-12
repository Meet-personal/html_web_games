<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Game\GameService;
use App\Models\Category;
use App\Models\Game;
use App\Models\GameImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class GameController extends Controller
{

    protected $model = "Games";
    protected $icon = 'bi bi-puzzle-fill';
    protected $index = "index";

    protected $gameService;
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function index()
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Index";
        return view('admin.game.index', compact('model', 'icon', 'label'));
    }


    public function getGame()
    {
        $searchTerm = request()->get('search')['value'];
        // Initialize the query with the category relationship
        $games = Game::query();

        if (!empty($searchTerm)) {
            $games = $games->where('name', 'LIKE', "%{$searchTerm}%")

                ->orWhereHas('category', function ($query) use ($searchTerm) {
                    $query->where('title', 'LIKE', "%{$searchTerm}%");
                });
        }
        $games = $games->with(['category:id,category_id,title'])->orderBy('created_at', 'desc')->get();
        // Log::info($games->toSql(), $games->getBindings());


        // Process DataTables
        return DataTables::of($games)
            ->addColumn('category_id', function ($game) {
                // Retrieve the category name
                return $game->category ? $game->category->title : "";
            })
            ->addColumn('name', function ($game) {
                // Retrieve the game name
                return $game->name;
            })
            ->addColumn('description', function ($game) {
                // Retrieve the game description
                return $game->description;
            })
            ->addColumn('image', function (Game $game) {
                // Generate the image HTML
                $image = common_image($game->image);
                return '<img src="' . htmlspecialchars($image, ENT_QUOTES, 'UTF-8') . '" width="100" height="100">';
            })
            ->addColumn('status', function ($game) {
                // Return the game status
                return $game->status ? "Active" : "Inactive";
            })
            ->addColumn('display_on_home', function ($game) {
                return $game->display_on_home;
                if ($game->display_on_home == 1) {
                    return "Yes";
                } else {
                    return "No";
                }
                // Return the display_on_home status
                // return $game->display_on_home == 1 ? "Yes" : "No"; // Assuming it’s a boolean field
            })

            ->addColumn('keyword', function ($game) {
                // Return the display_on_home status
                return $game->keyword; // Assuming it’s a boolean field
            })

            ->addColumn('action', function ($game) {
                // Generate action buttons
                return '
                    <a class="btn-icon text-warning"  data-toggle="tooltip" data-placement="top" title="View"  href="' . route('admin.game.view', $game->id) . '"><i class="bi bi-eye"></i></a>
                    <a class="btn-icon text-info"  data-toggle="tooltip" data-placement="top" title="Edit" href="' . route('admin.game.edit', $game->id) . '"><i class="bi bi-pencil"></i></a>
                    <a class="btn-icon text-danger"data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteItem(' . $game->id . ')"><i class="bi bi-trash"></i></a>
                    <a href="' . $game->url . '" target="_blank" data-toggle="tooltip" data-placement="top" title="Link"><i class="bi bi-link"></i></a>
                ';
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
        $gameCount = Game::count();
        $sortorder = $gameCount + 1;

        $categories = $this->getCategorySchema()->get();
        $arrayGameKeywords = $this->getGameKeywords();
        $unqKeywords = unique_game_keywords($arrayGameKeywords);
        return view('admin.game.create', compact('categories', 'unqKeywords', 'sortorder', 'model', 'icon', 'label'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|string',
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'description' => 'required',
            'url' => 'required|url|unique:games,url',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'vertical_image' => 'required|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'display_on_home' => 'nullable|boolean',
            'keyword' => 'required',
        ]);
        // dd($request->all());sd
        $this->gameService->store();
        return redirect()->route('admin.game.index');
    }



    public function destroy($id)
    {
        $item = Game::find($id);
        if ($item) {
            $item->delete();
            return response()->json(['success' => true, 'message' => 'Game deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Game not found.']);
    }

    public function additionalGameImageDestroy($id)
    {
        $item = GameImage::find($id);
        if ($item) {
            $item->delete();
            return response()->json(['success' => true, 'message' => 'Game image deleted successfully.']);
        }
        return response()->json(['success' => false, 'message' => 'Game image not found.']);
    }

    public function edit($id)
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = "Edit";
        $categories = $this->getCategorySchema()->get();

        $gameSorts = Game::all('id');

        $game = Game::with(['category:id,category_id,title', 'gameImages'])->find($id);

        $arrayGameKeywords = $this->getGameKeywords();
        $unqKeywords = unique_game_keywords($arrayGameKeywords);
        return view('admin.game.edit', compact('game', 'categories', 'unqKeywords', 'gameSorts', 'model', 'icon', 'label'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|string',
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'description' => 'required',
            'url' => 'required|url|unique:games,url,' . $id,
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'vertical_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'keyword' => 'required|max:100',
        ]);



        // dd($request->all());
        $this->gameService->update($id);
        return redirect()->route('admin.game.index');
    }


    public function view($id)
    {
        $model = $this->model;
        $icon = $this->icon;
        $label = 'View';
        $game = Game::with(['category:id,category_id,title', 'gameImages'])->find($id);
        return view('admin.game.view', compact('game', 'model', 'icon', 'label'));
    }




    /**
     * Helper functions
     */

    protected function getCategorySchema()
    {
        return Category::where('status', 1);
    }
    protected function getGameSchema()
    {
        return Game::where('status', 1);
    }
    protected function getGameKeywords()
    {
        return $this->getGameSchema()->select('keyword')->get()->pluck('keyword')->toArray();
    }
}
