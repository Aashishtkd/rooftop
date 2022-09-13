<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DishCategoryController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// Front Routes

Route::prefix('')->group(function(){
    Route::name('')->group(function(){

        // Front Routes
        Route::prefix('')->group(function () {
            Route::controller(FrontPageController::class)->group(function () {
                Route::name('')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/menu', 'menu')->name('menu');
                    Route::get('/order', 'order')->name('order');
                    Route::post('/single', 'single')->name('single');
                    Route::post('/completeorder', 'completeOrder')->name('completeorder');
                    Route::get('/contact', 'contact')->name('contact');
                    Route::get('/about', 'about')->name('about');
                    Route::post('/createcontact', 'createContact')->name('createcontact');
                });
            });
        });

    });
});

// Admin Routes

Route::prefix('admin')->group(function(){
    Route::name('admin.')->group(function(){

        // Front Routes
        Route::prefix('')->group(function () {
            Route::controller(AdminPageController::class)->group(function () {
                Route::name('')->group(function () {
                    Route::get('/', 'index')->name('index');
                });
            });
        });

        // Dish Category Routes
        Route::prefix('dishcategory')->group(function () {
            Route::controller(DishCategoryController::class)->group(function () {
                Route::name('dishcategory.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/add', 'add')->name('add');
                    Route::post('/create', 'create')->name('create');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::post('/update', 'update')->name('update');
                    Route::get('/delete/{id}', 'delete')->name('delete');
                });
            });
        });

        // Dish Routes
        Route::prefix('dish')->group(function () {
            Route::controller(DishController::class)->group(function () {
                Route::name('dish.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/add', 'add')->name('add');
                    Route::post('/create', 'create')->name('create');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::post('/update', 'update')->name('update');
                    Route::get('/delete/{id}', 'delete')->name('delete');
                });
            });
        });

        // Order Routes
        Route::prefix('order')->group(function () {
            Route::controller(OrderController::class)->group(function () {
                Route::name('order.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/single/{id}', 'single')->name('single');
                    Route::get('/complete/{id}', 'complete')->name('complete');
                    Route::get('/delete/{id}', 'delete')->name('delete');
                });
            });
        });

        // Contact Routes
        Route::prefix('contact')->group(function () {
            Route::controller(ContactController::class)->group(function () {
                Route::name('contact.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/single/{id}', 'single')->name('single');
                    Route::get('/delete/{id}', 'delete')->name('delete');
                });
            });
        });


    });
});


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
