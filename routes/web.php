<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
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

Route::get('/',[\App\Http\Controllers\Frontend\FrontendController::class,'index']);
Route::get('/detail/news/{slug}',[\App\Http\Controllers\Frontend\FrontendController::class,'detailNews'])->name('detailNews');
Route::get('/detail/category/{slug}',[\App\Http\Controllers\Frontend\FrontendController::class, 'detailCategory'])->name('detailCategory');
Auth::routes();

//handle redirect reegister to login
// Route::match(['GET','POST'], '/register',
// function(){
//     return  redirect('login');\
// }
// );


//route for news using resource


//middleware for admin panel
Route::resource('category', CategoryController::class)->middleware('auth');
//route midleware
Route::middleware('auth')->group(function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile',[\App\Http\Controllers\Profile\ProfilController::class,'index'])->name('profile');
    Route::get('/change-password', [\App\Http\Controllers\Profile\ProfilController::class,'changePassword'])->name('profile.change-password');
    Route::put('/update-password', [\App\Http\Controllers\Profile\ProfilController::class,'updatePassword'])->name('profile.update-password');
    Route::put('/reset-password/{id}', [\App\Http\Controllers\Profile\ProfilController::class,'resetPassword'])->name('resetpassword');
    Route::get('/create-profile',[\App\Http\Controllers\Profile\ProfilController::class,'createProfile'])->name('createprofile');
    Route::post('/store-profile',[\App\Http\Controllers\Profile\ProfilController::class,'storeProfile'])->name('storeprofile');
    Route::get('/edit-profile',[\App\Http\Controllers\Profile\ProfilController::class,'editProfile'])->name(('editProfile'));
    Route::put('/update-profile',[\App\Http\Controllers\Profile\ProfilController::class,'updateProfile'])->name('updateProfile');
        
    });
// route admin
Route::middleware(['auth','admin'])
->group(function() {
    // route for news usinng rsc
    Route::resource('news', NewsController::class);
    //route for category using rsc
    // except untuk menghilankan fungsi
    //only hanya untuk menampilkan itu saja
Route::resource('category', CategoryController::class)->except('show');});

//  for user
Route::get('/all-user',[\App\Http\Controllers\Profile\ProfilController::class,'allUser'])->name('alluser');