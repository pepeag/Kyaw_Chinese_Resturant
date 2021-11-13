<?php

use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin#profile');
        } else if (Auth::user()->role == 'user') {
            return redirect()->route('user#index');
        }
    }
})->name('dashboard');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'AdminController@index')->name('admin#profile');
    // Route::get('logout','AdminController@logout');
    Route::post('update/{id}','AdminController@updateProfile')->name('admin#updateProfile');
    Route::post('changePassword/{id}','AdminController@changePassword')->name('admin#changePassword');
    Route::get('changePassword','AdminController@changePasswordPage')->name('admin#changePasswordPage');

    Route::get('category', 'CategoryController@category')->name('admin#category');
    Route::get('addCategory', 'CategoryController@addCategory')->name('admin#addCategory');
    Route::post('createCategory', 'CategoryController@createCategory')->name('admin#createCategory');
    Route::get('deleteCategory/{id}', 'CategoryController@deleteCategory')->name('admin#deleteCategory');
    Route::get('editCategory/{id}', 'CategoryController@editCategory')->name('admin#editCategory');
    Route::post('updateCategory/{id}', 'CategoryController@updateCategory')->name('admin#updateCategory');

    //Menu
    Route::get('menu', 'MenuController@menu')->name('admin#menu');
    Route::get('addMenu', 'MenuController@addMenu')->name('admin#addMenu');
    Route::post('insertMenu', 'MenuController@insertMenu')->name('admin#insertMenu');
    Route::get('deleteMenu/{id}', 'MenuController@deleteMenu')->name('admin#deleteMenu');
    Route::get('editMenu/{id}', 'MenuController@editMenu')->name('admin#editMenu');
    Route::post('updateMenu/{id}', 'MenuController@updateMenu')->name('admin#updateMenu');

    //Order
    Route::get('order', 'OrderController@order')->name('admin#order');
    Route::get('order/search', 'OrderController@orderSearch')->name('admin#search');

    Route::get('total', 'OrderController@total')->name('admin#total');
    Route::get('total/search', 'OrderController@totalSearch')->name('admin#totalSearch');
    Route::get('contact/list', 'ContactController@contactList')->name('admin#contactList');
    Route::get('contact/search', 'ContactController@contactSearch')->name('admin#contactSearch');
    Route::get('userList', 'UserController@userList')->name('admin#userList');
    Route::get('adminList', 'UserController@adminList')->name('admin#adminList');
    Route::get('userList/search', 'UserController@userSearch')->name('admin#userSearch');
    Route::get('userList/delete/{id}', 'UserController@userDelete')->name('admin#userDelete');
    Route::get('adminList/search', 'UserController@adminSearch')->name('admin#adminSearch');
    Route::get('adminList/delete/{id}', 'UserController@adminDelete')->name('admin#adminDelete');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'UserController@index')->name('user#index');
    Route::get('menuDetails/{id}', 'UserController@menuDetails')->name('user#menuDetails');
    Route::get('order', 'UserController@Order')->name('user#order');
    Route::post('order', 'UserController@placeOrder')->name('user#placeOrder');
    Route::post('contact/create', 'Admin\ContactController@createContact')->name('user#createContact');
});
