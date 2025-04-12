<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\Game\GameService;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\Game;
use App\Models\Keyword;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{

    public $gameService;
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;

        $carouselGameSliders = $this->gameService->getCarouselGames();
        view()->share('carouselGameSliders',$carouselGameSliders);
    }

    public function gameList(Request $request)
    {
        $limit = (int) $request->get('limit', 20);

        $isTrendingGame = $request->get('is_trending') ?? 0;
        $sortOrder = $request->get('sort', 'asc');
        $searchTerm = request()->get('search');
        $searchKeyword = request()->get('keyword', []);

        $selectedCategorySlug = $request->get('category');


        $gameQueryBuilder = $this->getGameQueryBuilder($searchTerm, $isTrendingGame, $selectedCategorySlug, $searchKeyword);
        $games = $gameQueryBuilder->orderBy('name', $sortOrder)->paginate($limit);

        // Create a query builder instance for the Game model
        $gamesimages = $this->getGameImages($searchTerm);

        // banners
        $banners = $this->getBanners($searchTerm);

        // keywords


        $keywords = $this->getGameKeywords($searchTerm, $isTrendingGame, $selectedCategorySlug, $gameQueryBuilder);

        $fullUrl = request()->fullUrlWithQuery(['limit' => $limit]);
        // dropdown for category
        $categoriesList = $this->categoriesList();

        $carouselGameSliders = $this->gameService->getCarouselGames();
        return view('frontend-new.games', compact('games', 'gamesimages', 'banners', 'keywords', 'sortOrder', 'categoriesList','carouselGameSliders'));
    }

    public function view(Request $request, $slug)
    {

        $limit = (int) $request->get('limit', 20);

        // Fetch current game
        $currentGame = Game::where('slug', $slug)->firstOrFail();
        $currentGameId = $currentGame->id;


        $searchTerm = request()->get('search', '');
        $gameQueryBuilder = Game::select('id', 'image', 'name', 'slug', 'keyword', 'description')->where('id', '!=', $currentGameId)->where('status', 1)->orderby('sort_order', 'asc');
        if (!empty($searchTerm)) {
            $gameQueryBuilder = $gameQueryBuilder->where('keyword', 'LIKE', "%{$searchTerm}%")
                ->orwhere('description', 'LIKE', "%{$searchTerm}%");
        }

        $relatedGames = $gameQueryBuilder->inRandomOrder()->paginate($limit);
        $fullUrl = request()->fullUrlWithQuery(['limit' => $limit]);

        //Carousel games slider
        $carouselGameSliders = $this->gameService->getCarouselGames();
        $game = Game::where('slug', $slug)->where('status', 1)->first();

        return view('frontend-new.game-detail', compact('game', 'relatedGames', 'carouselGameSliders', 'fullUrl'));
    }

    public function actionGames()
    {
        $searchTerm = request()->get('search');
        $gameQueryBuilder = Game::where('display_on_home', 1)->orderBy('sort_order', 'asc')->where('status', 1)->orderBy('sort_order', 'asc');

        if (!empty($searchTerm)) {
            $gameQueryBuilder = $gameQueryBuilder->where('keyword', 'LIKE', "%{$searchTerm}%");
        }
        $actionGames = $gameQueryBuilder->paginate(config('constants.user.user-paginate'));
        return view('frontend-new.action-game', compact('actionGames'));
    }

    public function trendingGames()
    {
        $searchTerm = request()->get('search');
        $gameQueryBuilder = Game::select('id', 'image', 'name', 'slug', 'keyword')->where('flag', 1)->where('status', 1)->orderBy('sort_order', 'asc');

        if (!empty($searchTerm)) {
            $gameQueryBuilder = $gameQueryBuilder->where('keyword', 'LIKE', "%{$searchTerm}%");
        }
        $trendingGames = $gameQueryBuilder->paginate(20);
        return view('frontend-new.trending-game', compact('trendingGames'));
    }


    public function carouselGames()
    {
        $searchTerm = request()->get('search');
        $carouselQueryBuilder = Game::select('id', 'image', 'name', 'slug', 'keyword')->orderBy('sort_order', 'asc')->where('status', 1);

        if (!empty($searchTerm)) {
            $carouselQueryBuilder = $carouselQueryBuilder->where('name', 'LIKE', "%{$searchTerm}%")->orwhere('keyword', 'LIKE', "%{$searchTerm}%");
        }

        $carouselGames = $carouselQueryBuilder->paginate(config('constants.user.user-paginate'));
        return view('frontend-new.carousel-game', compact('carouselGames'));
    }

    public function categoryGames($id)
    {

        $searchTerm = request()->get('search');

        $categoryGames = Category::with(['games' => function ($query) use ($searchTerm) {
            $query->where('status', 1)
                ->where('display_on_home', 1)
                ->orderBy('sort_order', 'asc')

                ->when($searchTerm, function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'like', "%$searchTerm%")
                        ->orWhere('description', 'like', "%$searchTerm%");
                });
        }])->where('id', $id)
            ->whereHas('games')
            ->where('status', 1)->orderBy('sort_order', 'asc')
            ->select('id', 'category_id', 'title', 'description')
            ->when($searchTerm, function ($query) use ($searchTerm) {
                $query->orWhere('title', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%");
            })
            ->get();
        return view('frontend-new.category-true-game', compact('categoryGames'));
    }



    public function categoryList()
    {
        $searchTerm = request()->get('search');

        $categoryGames = Category::with(['games' => function ($query) use ($searchTerm) {
            $query->where('status', 1)
                ->where('display_on_home', 1)
                ->orderBy('sort_order', 'asc')
                ->when($searchTerm, function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'like', "%$searchTerm%")
                        ->orWhere('description', 'like', "%$searchTerm%");
                });
        }])
            ->whereHas('games', function ($query) use ($searchTerm) {
                $query->orWhere('name', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%");
            })
            ->where('status', 1)->orderBy('sort_order', 'asc')
            ->select('id', 'category_id', 'title', 'description')

            ->when($searchTerm, function ($query) use ($searchTerm) {
                $query->orWhere('title', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%");
            })
            ->paginate(20);
        return view('frontend-new.category-game-list', compact('categoryGames'));
    }





    /**
     * Banners
     */

    protected function getBanners($searchTerm = "")
    {
        $banners = Banner::with(['game' => function ($query) use ($searchTerm) {
            $query->select('id', 'url', 'name', 'slug')->where('status', 1)->orderBy('sort_order', 'asc', 'fullUrl')
                ->when($searchTerm, function ($query, $searchTerm) {
                    $query->where('name', 'like', "%$searchTerm%")->where('slug', 'like', "%$searchTerm%");
                });
        }])
            ->select('id', 'image', 'title', 'category_id', 'game_id', 'url')
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('title', 'like', "%$searchTerm%")
                    ->orwhere('description', 'like', "%$searchTerm%");
            })->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->where('type', 'games')->inRandomOrder()->limit(3)->get();

        return $banners;
    }


    protected function getGameQueryBuilder($searchTerm, $isTrendingGame, $selectedCategorySlug, $keywords = "")
    {
        $arrayKeywords = [];
        if (!empty($keywords)) {
            $arrayKeywords = explode(',', $keywords);
        }
        $gameQueryBuilder = Game::where('status', 1);
        if (!empty($searchTerm)) {
            $gameQueryBuilder = $gameQueryBuilder->where('keyword', 'LIKE', "%{$searchTerm}%")
                ->orwhere('name', 'LIKE', "%{$searchTerm}%");
        }
        if ($isTrendingGame == 1) {
            $gameQueryBuilder->where('flag', '1');
        }
        // Category filtering

        if (!empty($selectedCategorySlug) && $selectedCategorySlug !== '0' &&  $selectedCategorySlug != 'all') {
            $category = Category::where('slug', $selectedCategorySlug)->first();
            if ($category) {
                $gameQueryBuilder->where('category_id', $category->id);
            }
        }
        // Filter by selected keyword
        if (!empty($arrayKeywords)) {
            $gameQueryBuilder->where(function ($query) use ($arrayKeywords) {
                foreach ($arrayKeywords as $keyword) {
                    $keyword = trim($keyword);
                    if (!empty($keyword)) {
                        $query->orWhere('keyword', 'LIKE', "%{$keyword}%");
                    }
                }
            });
        }
        return $gameQueryBuilder;
    }



    /**
     * Only those categories who have game at list
     */
    protected function categoriesList()
    {
        return Category::where('status', 1)->whereHas('games')->get();
    }

    protected function getGameKeywords($search, $isTrendingGame, $selectedCategorySlug, $gameQueryBuilder)
    {
        if (!empty($search)) {
            $gameQueryBuilder->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")

                    ->orWhereHas('category', function ($subQuery) use ($search) {
                        $subQuery->where('title', 'like', "%{$search}%");
                    });
            });
        } else {
            $gameQueryBuilder->where('flag', 1);
        }


        if (!empty($selectedCategorySlug) && $selectedCategorySlug != 'all') {
            $category = Category::where('slug', $selectedCategorySlug)->first();
            if ($category) {
                $gameQueryBuilder->where('category_id', $category->id)->where('flag', 1);
            }
        }

        // Apply keywords filter

        $keywords = $gameQueryBuilder->where('flag', 1)->limit(50)->get();
        return $keywords;
    }

    protected function getGameImages($searchTerm)
    {
        // Create a query builder instance for the Game model
        $gamesQuery = Game::query();
        if (request()->has('search')) {
            $searchTerm = request()->input('search', '');
            $gamesQuery->where('name', 'like', "%{$searchTerm}%");
        }
        $categories = Category::where('display_on_home', 1)->pluck('id');
        if ($categories->isNotEmpty()) {
            $gamesQuery->whereIn('category_id', $categories);
        }
        $gamesQuery->orderBy('sort_order', 'asc')->where('status', 1);
        $gameImages = $gamesQuery->paginate(6);
        return $gameImages;
    }
    public function homePage()
    {
        return view('frontend-new.home-page');
    }
}
