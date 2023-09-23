<?php

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

/* User Auth*/
//if auth
Route::group(['middleware' => 'redirectIfAuth'], function () {
    Route::get('/login', 'User\Auth\AuthController@showLogin');
    Route::post('/login', 'User\Auth\AuthController@postLogin');

    Route::get('/register', 'User\Auth\AuthController@showRegister');
    Route::post('/register', 'User\Auth\AuthController@postRegister');
});
//if not auth
Route::group(['middleware' => 'redirectIfNotAuth'], function () {
    Route::get('/logout', 'User\Auth\AuthController@logout');
    Route::get('/profile', 'User\PageController@showProfile');
    Route::get('/edit-user_info/{id}', 'User\PageController@showEditUserInfo');
    Route::post('/update-user_info/{id}', 'User\PageController@updateUserInfo');
    Route::get('/delete/{id}', 'User\PageController@destroy');
});

/* User Home */
Route::get('/', 'User\PageController@home');
Route::get('/products/detail/{slug}', 'User\ProductController@detail');
Route::get('/products', 'User\PageController@allProducts');
Route::get('/aboutUs', 'User\PageController@about');
Route::get('/contactUs', 'User\PageController@contact');
Route::get('/locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    if ($locale === 'mm') {
        return redirect()->back()->with('success', 'ဘာသာစကား ပြောင်းလဲပြီးပါပြီ');
    }
    return redirect()->back()->with('success', 'Language changed');
});

/* Admin Routes */
Route::get('/admin/login', 'Admin\PageController@showLogin');
Route::post('/admin/login', 'Admin\PageController@login');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['admin']], function () {
    Route::post('logout', 'PageController@logout');
    Route::get('/', 'PageController@showDashboard');
    Route::resource('/category', 'CategoryController');
    Route::resource('/color', 'ColorController');
    Route::resource('/brand', 'BrandController');
    Route::resource('/supplier', 'SupplierController');
    Route::resource('/income', 'IncomeController');
    Route::resource('/outcome', 'OutcomeController');

    //product routes
    Route::resource('/product', 'ProductController');
    Route::post('/product/image-upload', 'ProductController@imageUpload');
    Route::get('/product_images', 'ProductController@images');
    Route::get('/add-product_images/{id}', 'ProductController@showAddImages');
    Route::post('/add-product_images/{id}', 'ProductController@storeImages');
    Route::get('/edit-product_images/{id}', 'ProductController@showEditImages');
    Route::post('/edit-product_images/{id}', 'ProductController@updateEditImages');

    //product transaction
    Route::get('/product-add/{slug}', 'ProductController@createProductAdd');
    Route::post('/product-add/{slug}', 'ProductController@storeProductAdd');
    Route::get('product-remove/{slug}', 'ProductController@createProductRemove');
    Route::post('product-remove/{slug}', 'ProductController@storeProductRemove');
    Route::get('/product-add-transaction', 'TransactionController@addTransaction');
    Route::get('/product-remove-transaction', 'TransactionController@removeTransaction');

    //order
    Route::get('/order', 'OrderController@all');
    Route::get('/change-order', 'OrderController@changeOrderStatus');

    //admin
    Route::get('/profile/{id}', 'PageController@profile');
    Route::post('/profile/{id}', 'PageController@updateProfile');
    Route::get('/handle_users', 'UserController@showUsers');
    Route::post('/manage_user/{id}', 'UserController@manageUser');
    Route::delete('/manage_user/{id}', 'UserController@destroy');
});
