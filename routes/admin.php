<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\FeedBackController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\KeywordController;
use App\Http\Controllers\Admin\StateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['isAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return 'Dashboard';
    });
});

Auth::routes();
Route::group(['prefix' => 'admin/'], function () {

    Route::get('register', [AdminController::class, 'register'])->name('admin.register');
    Route::get('login', [AdminController::class, 'loginForm'])->name('admin.loginForm');
    Route::get('forgotpassword', [AdminController::class, 'forgotpassword'])->name('admin.forgotpassword');
    Route::post('login', [AdminController::class, 'doLogin'])->name('login.functionality');
    // Route::get('dashboard-create', [AdminController::class, 'dashboardCreate'])->name('admin.dashboard-create');


    Route::group(['middleware' => 'admin'], function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    });
    Route::group(['prefix' => 'profile/'], function () {
        Route::post('update', [AdminController::class, 'update'])->name('admin.profile.update');
    });



});

Route::group(['prefix' => 'admin/', 'middleware' => 'admin'], function () {


    Route::group(['prefix' => 'categories/'], function () {
        Route::get('', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('data', [CategoryController::class, 'getCategories'])->name('admin.categories.data');
        Route::get('create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('view/{id}', [CategoryController::class, 'view'])->name('admin.categories.view');
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
    });

    Route::group(['prefix' => 'games/'], function () {
        Route::get('', [GameController::class, 'index'])->name('admin.game.index');
        Route::get('data', [GameController::class, 'getGame'])->name('admin.game.data');
        Route::get('create', [GameController::class, 'create'])->name('admin.game.create');
        Route::post('store', [GameController::class, 'store'])->name('admin.game.store');
        Route::get('edit/{id}', [GameController::class, 'edit'])->name('admin.game.edit');
        Route::post('update/{id}', [GameController::class, 'update'])->name('admin.game.update');
        Route::get('view/{id}', [GameController::class, 'view'])->name('admin.game.view');
        Route::delete('/delete/{id}', [GameController::class, 'destroy'])->name('admin.game.delete');
        Route::delete('/additional-image/delete/{id}', [GameController::class, 'additionalGameImageDestroy'])->name('admin.game-images.delete');
    });
    Route::group(['prefix' => 'countries/'], function () {
        Route::get('', [CountryController::class, 'index'])->name('admin.countries.index');
        Route::get('data', [CountryController::class, 'getCountries'])->name('admin.countries.data');
        Route::get('create', [CountryController::class, 'create'])->name('admin.countries.create');
        Route::post('store', [CountryController::class, 'store'])->name('admin.countries.store');
        Route::get('edit/{id}', [CountryController::class, 'edit'])->name('admin.countries.edit');
        Route::post('update/{id}', [CountryController::class, 'update'])->name('admin.countries.update');
        Route::delete('/delete/{id}', [CountryController::class, 'destroy'])->name('admin.countries.delete');
    });

    Route::group(['prefix' => 'states/'], function () {
        Route::get('', [StateController::class, 'index'])->name('admin.states.index');
        Route::get('data', [StateController::class, 'getStates'])->name('admin.states.data');
        Route::get('create', [StateController::class, 'create'])->name('admin.states.create');
        Route::post('store', [StateController::class, 'store'])->name('admin.states.store');
        Route::get('edit/{id}', [StateController::class, 'edit'])->name('admin.states.edit');
        Route::post('update/{id}', [StateController::class, 'update'])->name('admin.states.update');
        Route::delete('/delete/{id}', [StateController::class, 'destroy'])->name('admin.states.delete');
    });

    Route::group(['prefix' => 'cities/'], function () {
        Route::get('', [CityController::class, 'index'])->name('admin.cities.index');
        Route::get('data', [CityController::class, 'getCities'])->name('admin.cities.data');
        Route::get('create', [CityController::class, 'create'])->name('admin.cities.create');
        Route::post('store', [CityController::class, 'store'])->name('admin.cities.store');
        Route::get('edit/{id}', [CityController::class, 'edit'])->name('admin.cities.edit');
        Route::post('update/{id}', [CityController::class, 'update'])->name('admin.cities.update');
        Route::delete('/delete/{id}', [CityController::class, 'destroy'])->name('admin.cities.delete');
    });
    Route::group(['prefix' => 'banners/'], function () {
        Route::get('', [BannerController::class, 'index'])->name('admin.banners.index');
        Route::get('data', [BannerController::class, 'getBanners'])->name('admin.banners.data');
        Route::get('create', [BannerController::class, 'create'])->name('admin.banners.create');
        Route::post('store', [BannerController::class, 'store'])->name('admin.banners.store');
        Route::get('edit/{id}', [BannerController::class, 'edit'])->name('admin.banners.edit');
        Route::post('update/{id}', [BannerController::class, 'update'])->name('admin.banners.update');
        Route::delete('/delete/{id}', [BannerController::class, 'destroy'])->name('admin.banners.delete');
    });


    Route::group(['prefix' => 'faqs/'], function () {
        Route::get('', [FaqsController::class, 'index'])->name('admin.faqs.index');
        Route::get('data', [FaqsController::class, 'getFaqs'])->name('admin.faqs.data');
        Route::get('create', [FaqsController::class, 'create'])->name('admin.faqs.create');
        Route::post('store', [FaqsController::class, 'store'])->name('admin.faqs.store');
        Route::get('edit/{id}', [FaqsController::class, 'edit'])->name('admin.faqs.edit');
        Route::post('update/{id}', [FaqsController::class, 'update'])->name('admin.faqs.update');
        Route::delete('/delete/{id}', [FaqsController::class, 'destroy'])->name('admin.faqs.delete');
    });


    Route::group(['prefix' => 'cms/'], function () {
        Route::get('', [CmsController::class, 'index'])->name('admin.cms.index');
        Route::get('data', [CmsController::class, 'getCms'])->name('admin.cms.data');
        // Route::get('create', [CmsController::class, 'create'])->name('admin.cms.create');

        // Route::post('store', [CmsController::class, 'store'])->name('admin.cms.store');
        // Route::delete('/delete/{id}', [CmsController::class, 'destroy'])->name('admin.cms.delete');

        Route::get('edit/{id}', [CmsController::class, 'edit'])->name('admin.cms.edit');
        Route::post('update/{id}', [CmsController::class, 'update'])->name('admin.cms.update');
    });

    Route::group(['prefix' => 'keyword/'], function () {
        Route::get('index', [KeywordController::class, 'index'])->name('admin.keyword.index');
        Route::get('data', [KeywordController::class, 'getKeyword'])->name('admin.keyword.data');
        Route::get('create', [KeywordController::class, 'create'])->name('admin.keyword.create');
        Route::post('store', [KeywordController::class, 'store'])->name('admin.keyword.store');
        Route::get('edit/{id}', [KeywordController::class, 'edit'])->name('admin.keyword.edit');
        Route::post('update/{id}', [KeywordController::class, 'update'])->name('admin.keyword.update');
    });

    Route::group(['prefix' => 'feedbacks/'], function () {
        Route::get('index', [FeedBackController::class, 'index'])->name('admin.feedbacks.index');
        Route::delete('/delete/{id}', [FeedBackController::class, 'destroy'])->name('admin.feedbacks.delete');

        // Route::resource('', FeedBackController::class);
    });

});







