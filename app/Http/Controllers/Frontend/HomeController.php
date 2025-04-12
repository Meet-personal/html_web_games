<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\Game\GameService;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Cms;
use App\Models\Country;
use App\Models\Game;
use DB;
use GuzzleHttp\Psr7\Request;

class HomeController extends Controller
{

    public $gameService;
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }


    public function indexOld()
    {
        $searchTerm = request('search');
        // banners
        $banners = Banner::with(['game' => function ($query) use ($searchTerm) {
            $query->select('id', 'url', 'name', 'slug', 'description')->where('status', 1)->orderBy('sort_order', 'asc')
                ->when($searchTerm, function ($query, $searchTerm) {
                    $query->where('name', 'like', "%$searchTerm%")
                        ->where('description', 'like', "%$searchTerm%")
                    ;
                });
        }])->select('id', 'image', 'title', 'game_id', 'category_id', 'description', 'url')
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('title', 'like', "%$searchTerm%")
                    ->where('description', 'like', "%$searchTerm%");
            })->where('status', 1)->orderBy('sort_order', 'asc')->where('type', 'home')->inRandomOrder()->get();


        //Trending games
        $trendingGames = Game::select('id', 'image', 'name', 'slug', 'flag', 'keyword', 'description')
            ->where('flag', 1)->where('status', 1)
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('name', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%")
                    ->orWhere('keyword', 'like', "%$searchTerm%");
            })
            ->inRandomOrder()
            ->limit(8)
            ->orderBy('sort_order', 'asc')
            ->get();


        //Carousel games slider
        $carouselGameSliders = $this->gameService->getCarouselGames();
        //Display only those games which category is display on home true.
        $categoriesGames = Category::with(['games' => function ($query) use ($searchTerm) {
            $query->where('status', 1)
                ->where('display_on_home', 1)
                ->limit(config('constants.user.frontend.category_game_count'))
                ->when($searchTerm, function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'like', "%$searchTerm%")
                        ->orWhere('description', 'like', "%$searchTerm%");
                });
        }])
            ->where('status', 1)
            ->where('display_on_home', 1)
            ->select('id', 'category_id', 'title', 'description', 'slug')
            ->when($searchTerm, function ($query) use ($searchTerm) {
                // Check if search term is a category name and filter accordingly
                $query->where('title', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%");
            })
            ->when($searchTerm, function ($query) use ($searchTerm) {
                // Also filter categories that have games matching the search term
                $query->orWhereHas('games', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', "%$searchTerm%")
                        ->orWhere('description', 'like', "%$searchTerm%");
                });
            })
            ->orderBy('sort_order', 'asc')
            ->take(5)
            ->get();

        // Log the executed query
        $queries = DB::getQueryLog();


        // $categoriesGames = Category::with(['games' => function ($query) use ($searchTerm) {
        //     $query->where('status', 1)
        //         ->where('display_on_home', 1)
        //         ->limit(config('constants.user.frontend.category_game_count'))
        //         ->when($searchTerm, function ($query) use ($searchTerm) {
        //             $query->orWhere('name', 'like', "%$searchTerm%")
        //                 ->orWhere('description', 'like', "%$searchTerm%");
        //         });
        // }])
        //     ->whereHas('games', function ($query) use ($searchTerm) {
        //         $query->orWhere('name', 'like', "%$searchTerm%")
        //             ->orWhere('description', 'like', "%$searchTerm%");
        //     })
        //     ->where('status', 1)
        //     ->where('display_on_home', 1)
        //     ->select('id', 'category_id', 'title', 'description')
        //     ->when($searchTerm, function ($query, $searchTerm) {
        //         $query->orWhere('title', 'like', "%$searchTerm%")
        //             ->orWhere('description', 'like', "%$searchTerm%");
        //     })
        //     ->orderBy('sort_order', 'asc')->take(5)
        //     ->get();
        // $queries = DB::getQueryLog();

        //   end category
        // display on home=1;
        // $displayHomePageGames = Category::with(['games' => function ($query) {
        //     $query->limit(config('constants.user.frontend.category_game_count'));
        // }])
        //     ->whereHas('games')
        //     ->where('status', 1)
        //     ->where('display_on_home', 1)->select('id', 'category_id', 'title')
        //     ->get();


        return view('frontend.homepage.index', compact('banners', 'trendingGames', 'carouselGameSliders', 'categoriesGames'));
    }

    public function index()
    {
        $searchTerm = request('search');
        // banners
        $banners = Banner::with(['game' => function ($query) use ($searchTerm) {
            $query->select('id', 'url', 'name', 'slug', 'description')->where('status', 1)->orderBy('sort_order', 'asc')
                ->when($searchTerm, function ($query, $searchTerm) {
                    $query->where('name', 'like', "%$searchTerm%")
                        ->where('description', 'like', "%$searchTerm%")
                    ;
                });
        }])->select('id', 'image', 'title', 'game_id', 'category_id', 'description', 'url')
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('title', 'like', "%$searchTerm%")
                    ->where('description', 'like', "%$searchTerm%");
            })->where('status', 1)->orderBy('sort_order', 'asc')->where('type', 'home')->inRandomOrder()->get();


        //Trending games
        $trendingGames = Game::select('id', 'image', 'name', 'slug', 'flag', 'keyword', 'description')
            ->where('flag', 1)->where('status', 1)
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('name', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%")
                    ->orWhere('keyword', 'like', "%$searchTerm%");
            })
            ->inRandomOrder()
            ->limit(8)
            ->orderBy('sort_order', 'asc')
            ->get();


        //Carousel games slider
        $carouselGameSliders = $this->gameService->getCarouselGames();
        //Display only those games which category is display on home true.
        $categoriesGames = Category::with(['games' => function ($query) use ($searchTerm) {
            $query->where('status', 1)
                ->where('display_on_home', 1)
                ->limit(config('constants.user.frontend.category_game_count'))
                ->when($searchTerm, function ($query) use ($searchTerm) {
                    $query->orWhere('name', 'like', "%$searchTerm%")
                        ->orWhere('description', 'like', "%$searchTerm%");
                });
        }])
            ->where('status', 1)
            ->where('display_on_home', 1)
            ->select('id', 'category_id', 'title', 'description', 'slug')
            ->when($searchTerm, function ($query) use ($searchTerm) {
                // Check if search term is a category name and filter accordingly
                $query->where('title', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%");
            })
            ->when($searchTerm, function ($query) use ($searchTerm) {
                // Also filter categories that have games matching the search term
                $query->orWhereHas('games', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', "%$searchTerm%")
                        ->orWhere('description', 'like', "%$searchTerm%");
                });
            })
            ->orderBy('sort_order', 'asc')
            ->take(5)
            ->get();

        // Log the executed query
        $queries = DB::getQueryLog();

        return view('frontend-new.home', compact('banners', 'trendingGames', 'carouselGameSliders', 'categoriesGames'));
    }


    public function cmsPage($slug)
    {
        $cms  = Cms::where('slug', $slug)->first();
        $carouselGameSliders = $this->gameService->getCarouselGames();
        if (!$cms) {
            abort(404, 'Content not found');
        }
        return view('frontend-new.cms', compact('cms','carouselGameSliders'));
    }
}
