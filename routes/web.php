<?php

use App\Http\Controllers\AdminController\CategoryController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    //Category
    Route::group(['controller' => CategoryController::class, 'as' => 'category.', 'prefix' => 'category'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{categoryModel}', 'edit')->name('edit');
        Route::patch('update/{categoryModel}', 'update')->name('update');
        Route::delete('destroy/{categoryModel}', 'destroy')->name('destroy');
    });
});
