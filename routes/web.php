<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@index');
Route::get('home1', 'HomeController@index1');
Auth::routes();
// Route::get('/login', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'dashboardController@index')->middleware('auth');
Route::get('/admin/user/list', 'adminUserController@list');
Route::post('/admin/user/list', 'adminUserController@action');
Route::get('/admin/user/add', 'adminUserController@add');
Route::get('/admin/user/delete/{id}', 'adminUserController@delete')->name('user.delete');
Route::get('/admin/user/edit/{id}', 'adminUserController@edit')->name('user.edit');
Route::post('/admin/user/update/{id}', 'adminUserController@update')->name('user.update');
Route::post('/admin/user/store', 'adminUserController@store');
Route::post('/admin/product/store', 'adminProductController@store');
Route::get('/admin/product/add', 'adminProductController@add');
Route::get('/admin/product/list', 'adminProductController@list')->name('product.list');
Route::get('/admin/product/edit/{id}', 'adminProductController@edit')->name('product.edit');
Route::post('/admin/product/update/{id}', 'adminProductController@update')->name('product.update');
Route::get('/admin/product/delete/{id}', 'adminProductController@delete')->name('product.delete');
Route::post('/admin/product/list', 'adminProductController@action');
Route::get('/admin/product/cat/list', 'adminProductController@Cat');
Route::get('/admin/page/add', 'adminPageController@add');
Route::get('/admin/page/list', 'adminPageController@list');
Route::get('/admin/post/list', 'adminPostController@list');
Route::post('/admin/post/store', 'adminPostController@store');
Route::get('/admin/post/delete/{id}', 'adminPostController@delete')->name('post.delete');
Route::get('/admin/post/edit/{id}', 'adminPostController@edit')->name('post.edit');
Route::post('/admin/post/update/{id}', 'adminPostController@update')->name('post.update');

Route::get('/admin/post/add', 'adminPostController@add');
Route::post('/admin/post/list', 'adminPostController@action');
Route::get('/admin/post/cat/list', 'adminPostController@cat');
Route::get('/admin/order/list', 'adminOrderController@list');
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::get('/post', 'clientPostController@index');
Route::get('/about', 'clientAboutController@index');
Route::get('/post/detail/{id}', 'clientPostController@detail')->name('post.detail');
Route::get('/product', 'clientProductController@index');
Route::get('/product/detail/{id}', 'clientProductController@detail')->name('product.detail');
Route::get('categories', 'CategoryController@index');
Route::get('product_category/{id}', 'clientProductController@category_list')->name('product.category');
Route::get('/cart', 'CartController@show');
Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout');
Route::get('/cart/add/{id}', 'CartController@add')->name('cart.add');
Route::get('/cart/add/buynow/{id}', 'CartController@buynow')->name('cart.buynow');
route::get('cart/remove/{rowId}','cartController@remove')->name('cart.remove');
route::post('cart/update','cartController@update')->name('cart.update');
Route::post('cart/store', 'CartController@store');
Route::post('/admin/order/list', 'adminOrderController@action');
Route::get('/admin/order/delete/{id}', 'adminOrderController@delete')->name('order.delete');
Route::get('/admin/order/status_1', 'adminOrderController@status1')->name('order.status_1');
Route::get('/admin/order/status_2', 'adminOrderController@status2')->name('order.status_2');
Route::get('/admin/order/status_3', 'adminOrderController@status3')->name('order.status_3');
Route::get('/admin/product/status_1', 'adminProductController@status1')->name('product.status_1');
Route::get('/admin/product/status_2', 'adminProductController@status2')->name('product.status_2');
Route::get('/admin/product/status_3', 'adminProductController@status3')->name('product.status_3');
Route::get('/admin/post/status_1', 'adminPostController@status1')->name('post.status_1');
Route::get('/admin/post/status_2', 'adminPostController@status2')->name('post.status_2');
Route::get('/admin/post/status_3', 'adminPostController@status3')->name('post.status_3');









