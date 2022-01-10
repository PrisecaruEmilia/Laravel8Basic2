<?php

use App\Models\User;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = Brand::all();
    return view('home', compact('brands'));
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// category controllers

Route::get('/category/all', [CategoryController::class, 'allCategories'])->name('all.categories');
Route::post('/category/add', [CategoryController::class, 'addCategory'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'update']);
Route::get('/category/softdelete/{id}', [CategoryController::class, 'softdelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restore']);
Route::get('/category/pdelete/{id}', [CategoryController::class, 'permanentDelete']);

// brand controllers

Route::get('/brand/all', [BrandController::class, 'allBrands'])->name('all.brands');
Route::post('/store/add', [BrandController::class, 'addBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'delete']);

// multi image route
Route::get('/multi/images', [BrandController::class, 'multiPic'])->name('multi.images');
Route::post('/multi/add', [BrandController::class, 'addImages'])->name('store.images');

// ADMIN all routes

Route::get('/home/slider', [HomeController::class, 'homeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'addSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'storeSlider'])->name('store.slider');
Route::get('/slider/edit/{id}', [HomeController::class, 'editSlider']);
Route::post('/brand/update/{id}', [HomeController::class, 'updateSlider'])->name('update.slider');
Route::get('/slider/delete/{id}', [HomeController::class, 'deleteSlider']);














// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

//     // $users = User::all();
//     $users = DB::table('users')->get();
//     return view('dashboard', compact('users'));
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {


    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class, 'logoutUser'])->name('user.logout');
