<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    return view('home');
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












// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

//     // $users = User::all();
//     $users = DB::table('users')->get();
//     return view('dashboard', compact('users'));
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {


    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class, 'logoutUser'])->name('user.logout');
