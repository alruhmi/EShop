<?php


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
Route::get('/',function (){
    return redirect()->route('admin');
});

Route::get('/admin/', function () {
    return view('dashboard');
})->middleware('auth')->name('admin');

Auth::routes();
Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', 'dashboardController@index');

    Route::resource('product', 'ProductController');
    Route::POST('addProduct', 'ProductController@addProduct');
    Route::GET('showProduct', 'ProductController@showProduct');
    Route::POST('editProduct', 'ProductController@editProduct');
    Route::POST('deleteProduct', 'ProductController@deleteProduct');
    Route::POST('uploadImg', 'ProductController@uploadImg');
    Route::GET('loadImages', 'ProductController@loadImages');

    Route::resource('category', 'CategoryController');
    Route::GET('loadCategory', 'CategoryController@loadCategory');
    Route::GET('selectCategory', 'CategoryController@selectCategory');
    Route::POST('addCategory', 'CategoryController@addCategory');
    Route::POST('editCategory', 'CategoryController@editCategory');
    Route::POST('deleteCategory', 'CategoryController@deleteCategory');

    Route::resource('brand', 'BrandController');
    Route::GET('loadBrand', 'BrandController@loadBrand');
    Route::GET('selectBrand', 'BrandController@selectBrand');
    Route::POST('addBrand', 'BrandController@addBrand');
    Route::POST('editBrand', 'BrandController@editBrand');
    Route::POST('deleteBrand', 'BrandController@deleteBrand');

    Route::resource('customers', 'CustomersController');
    Route::POST('addCustomer', 'CustomersController@addCustomer');
    Route::GET('showCustomer', 'CustomersController@showCustomer');
    Route::POST('editCustomer', 'CustomersController@editCustomer');
    Route::POST('deleteCustomer', 'CustomersController@deleteCustomer');

    Route::resource('countries', 'CountryController');
    Route::GET('loadCountries', 'CountryController@loadCountries');
    Route::GET('selectCountry', 'CountryController@selectCountry');
    Route::POST('addCountry', 'CountryController@addCountry');
    Route::POST('editCountry', 'CountryController@editCountry');
    Route::POST('deleteCountry', 'CountryController@deleteCountry');

});

