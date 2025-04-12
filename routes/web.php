<?php

use App\Http\Controllers\Frontend\FeedbackController;
use App\Http\Controllers\Frontend\GameController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;






Route::resource('feedbacks', FeedbackController::class);
Route::get('', [HomeController::class, 'index'])->name('frontend.homepage.index');
Route::get('home-page', [GameController::class, 'homePage'])->name('frontend.homePage');
Route::get('games', [GameController::class, 'gameList'])->name('frontend.game');
Route::get('action-game', [GameController::class, 'actionGames'])->name('frontend.action-game');
Route::get('carousel-game', [GameController::class, 'carouselGames'])->name('frontend.carousel-game');
Route::get('category-true-game/{id}', [GameController::class, 'categoryGames'])->name('frontend.category-true-game');

Route::get('category-list', [GameController::class, 'categoryList'])->name('frontend.category-game-list');

// game detail
Route::get('/game/{slug}', [GameController::class, 'view'])->name('frontend.game_detail_page');
// privacy & policy route
Route::get('/{slug}', [HomeController::class, 'cmsPage'])->name('frontend.cms');



include 'admin.php';

