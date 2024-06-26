<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DishCategoryController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Auth::routes();

// Front Routes

// Route::prefix('')->group(function(){
//     Route::name('')->group(function(){

//         // Front Routes
//         Route::prefix('')->group(function () {
//             Route::controller(FrontPageController::class)->group(function () {
//                 Route::name('')->group(function () {
//                     Route::get('/', 'index')->name('index');
//                     Route::get('/menu', 'menu')->name('menu');
//                     Route::get('/cart', 'cart')->name('cart');
//                     Route::get('/blog', 'blog')->name('blog');
//                     Route::get('/blogDetails', 'blogDetails')->name('blogDetails');
//                     Route::get('/order', 'order')->name('order');
//                     Route::post('/single', 'single')->name('single');
//                     Route::post('/completeorder', 'completeOrder')->name('completeorder');
//                     Route::get('/contact', 'contact')->name('contact');
//                     Route::get('/about', 'about')->name('about');
//                     Route::post('/createcontact', 'createContact')->name('createcontact');
//                 });
//             });
//         });

//     });
// });

Route::prefix('')->group(function(){
    Route::name('')->group(function(){

        // Front Routes
        Route::prefix('')->group(function () {
            Route::controller(FrontController::class)->group(function () {
                Route::name('')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/mygallery', 'mygallery')->name('mygallery');
                    Route::get('/menu', 'menu')->name('menu');
                    Route::get('/book', 'book')->name('book');
                    Route::get('/cart', 'cart')->name('cart');
                    Route::get('/blog', 'blog')->name('blog');
                    Route::get('/blogDetails', 'blogDetails')->name('blogDetails');
                    Route::get('/order', 'order')->name('order');
                    Route::post('/single', 'single')->name('single');
                    Route::post('/checkoutorder', 'checkoutorder')->name('checkoutorder');
                    Route::get('/checkoutorder', 'getcheckoutorder')->name('getcheckoutorder');
                    Route::post('/confirmorder', 'confirmorder')->name('confirmorder');
                    Route::post('/completeorder', 'completeOrder')->name('completeorder');
                    Route::get('/contact', 'contact')->name('contact');
                    Route::get('/about', 'about')->name('about');
                    Route::post('/createcontact', 'createContact')->name('createcontact');
                    Route::post('/createbookings', 'createbookings')->name('createbookings');
                    Route::post('/addNewCart', 'addNewCart')->name('addNewCart');
                    Route::get('/bookingsuccess', 'bookingsuccess')->name('bookingsuccess');
                    Route::get('/ordersuccess', 'ordersuccess')->name('ordersuccess');
                    Route::get('/contactsuccess', 'contactsuccess')->name('contactsuccess');
                    Route::post('/decrementCart', 'decrementCart')->name('decrementCart');
                    Route::post('/incrementCart', 'incrementCart')->name('incrementCart');
                    Route::post('/deleteCart', 'deleteCart')->name('deleteCart');
                });
            });
        });
    });
});

// to upload photo on ckeditor
Route::post('/ckeditor/upload', [CkeditorController::class, 'upload'])->name('ckeditor.upload');

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

        // Blogs Routes
        Route::controller(BlogController::class)->group(function () {  
            Route::name('blog.')->group(function () {
                Route::get('blogIndex', 'index')->name('index');
                Route::get('blogForm', 'form')->name('form');
                Route::get('blog/loadtable', 'loadtable')->name('loadtable');
                Route::post('blog/destroy', 'destroy')->name('destroy');
                Route::post('blog/update', 'update')->name('update');
            });   
        });
        // gallery 
        Route::controller(GalleryController::class)->group(function () {  
            Route::name('gallery.')->group(function () {
                Route::get('galleryIndex', 'index')->name('index');
                Route::get('gallery/loadtable', 'loadtable')->name('loadtable');
                Route::post('gallery/destroy', 'destroy')->name('destroy');
                Route::post('gallery/update', 'update')->name('update');
            });   
        });
        // testimonials

        Route::controller(OtherController::class)->group(function () {  
            Route::name('others.')->group(function () {
                Route::get('testiIndex', 'tindex')->name('tindex');
                Route::get('testiForm', 'tform')->name('tform');
                Route::get('testi/tloadtable', 'tloadtable')->name('tloadtable');
                Route::post('testi/destroy', 'tdestroy')->name('tdestroy');
                Route::post('testi/update', 'tupdate')->name('tupdate');
                
            });   
        });
        // setting
        Route::controller(SettingController::class)->group(function () {  
            Route::name('settings.')->group(function () {
                Route::get('websetting', 'websetting')->name('web');
                Route::post('settings/update', 'update')->name('update');
            });   
        });
        // Dish Category Routes
        Route::prefix('dishcategory')->group(function () {
            Route::controller(DishCategoryController::class)->group(function () {
                Route::name('dishcategory.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/add', 'add')->name('add');
                    Route::post('/create', 'create')->name('create');
                    Route::post('/update', 'update')->name('update');
                    Route::post('/delete', 'delete')->name('delete');
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
                    Route::post('/update', 'update')->name('update');
                    Route::post('/delete', 'delete')->name('delete');
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
                    Route::post('/delete/', 'delete')->name('delete');
                });
            });
        });

        // Contact Routes
        Route::prefix('contact')->group(function () {
            Route::controller(ContactController::class)->group(function () {
                Route::name('contact.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/single/{id}', 'single')->name('single');
                    Route::post('/delete/', 'delete')->name('delete');
                });
            });
        });
        // Contact Routes
        Route::prefix('booking')->group(function () {
            Route::controller(BookingController::class)->group(function () {
                Route::name('booking.')->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/changestatus/{id}', 'changestatus')->name('changestatus');
                    Route::post('booking/destroy', 'destroy')->name('destroy');
                });
            });
        });


    });
});


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
