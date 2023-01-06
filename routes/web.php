<?php

use App\Http\Controllers\AdminController\CategoryController;
use App\Http\Controllers\AdminController\CouponController;
use App\Http\Controllers\AdminController\DiscountController;
use App\Http\Controllers\AdminController\OptionController;
use App\Http\Controllers\AdminController\ValueController;
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

    //Discount 
    Route::group(['controller' => DiscountController::class, 'as' => 'discount.', 'prefix' => 'discount'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{discountModel}', 'edit')->name('edit');
        Route::patch('update/{discountModel}', 'update')->name('update');
        Route::delete('destroy/{discountModel}', 'destroy')->name('destroy');
    });

    //Option 
    Route::group(['controller' => OptionController::class, 'as' => 'option.', 'prefix' => 'option'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{optionModel}', 'edit')->name('edit');
        Route::patch('update/{optionModel}', 'update')->name('update');
        Route::delete('destroy/{optionModel}', 'destroy')->name('destroy');
    });

    //Value 
    Route::group(['controller' => ValueController::class, 'as' => 'value.', 'prefix' => '{optionModel?}/value'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{valueModel}', 'edit')->name('edit');
        Route::patch('update/{valueModel}', 'update')->name('update');
        Route::delete('destroy/{valueModel}', 'destroy')->name('destroy');
    });

    //Discount 
    Route::group(['controller' => CouponController::class, 'as' => 'coupon.', 'prefix' => 'coupon'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{couponModel}', 'edit')->name('edit');
        Route::patch('update/{couponModel}', 'update')->name('update');
        Route::delete('destroy/{couponModel}', 'destroy')->name('destroy');
    });
});
