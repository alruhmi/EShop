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
Route::get('/admin',function (){
    return redirect()->route('admin');
});

Auth::routes();
Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('dashboard', 'AdminDashboardController@index')->name('admin');

    Route::resource('product', 'AdminProductController');
    Route::POST('addProduct', 'AdminProductController@addProduct');
    Route::GET('showProduct', 'AdminProductController@showProduct');
    Route::POST('editProduct', 'AdminProductController@editProduct');
    Route::POST('deleteProduct', 'AdminProductController@deleteProduct');
    Route::POST('uploadImg', 'AdminProductController@uploadImg');
    Route::GET('loadImages', 'AdminProductController@loadImages');
    Route::POST('addNewImg', 'AdminProductController@addNewImg');
    Route::POST('deleteSelectedImages', 'AdminProductController@deleteSelectedImages');

    Route::resource('category', 'AdminCategoryController');
    Route::GET('loadCategory', 'AdminCategoryController@loadCategory');
    Route::GET('selectCategory', 'AdminCategoryController@selectCategory');
    Route::POST('addCategory', 'AdminCategoryController@addCategory');
    Route::POST('editCategory', 'AdminCategoryController@editCategory');
    Route::POST('deleteCategory', 'AdminCategoryController@deleteCategory');

    Route::resource('brand', 'AdminBrandController');
    Route::GET('loadBrand', 'AdminBrandController@loadBrand');
    Route::GET('selectBrand', 'AdminBrandController@selectBrand');
    Route::POST('addBrand', 'AdminBrandController@addBrand');
    Route::POST('editBrand', 'AdminBrandController@editBrand');
    Route::POST('deleteBrand', 'AdminBrandController@deleteBrand');

    Route::resource('customers', 'AdminCustomersController');
    Route::POST('addCustomer', 'AdminCustomersController@addCustomer');
    Route::GET('showCustomer', 'AdminCustomersController@showCustomer');
    Route::POST('editCustomer', 'AdminCustomersController@editCustomer');
    Route::POST('deleteCustomer', 'AdminCustomersController@deleteCustomer');

    Route::resource('countries', 'AdminCountryController');
    Route::GET('loadCountries', 'AdminCountryController@loadCountries');
    Route::GET('selectCountry', 'AdminCountryController@selectCountry');
    Route::POST('addCountry', 'AdminCountryController@addCountry');
    Route::POST('editCountry', 'AdminCountryController@editCountry');
    Route::POST('deleteCountry', 'AdminCountryController@deleteCountry');

    Route::resource('news','AdminNewsController');
    Route::POST('addNews','AdminNewsController@addNews');
    Route::GET('showNews','AdminNewsController@showNews');
    Route::POST('editNews','AdminNewsController@editNews');
    Route::GET('activeNews','AdminNewsController@activeNews');
    Route::POST('changePosition','AdminNewsController@changePosition');

});

