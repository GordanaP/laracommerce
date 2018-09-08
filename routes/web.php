<?php


Route::view('/', 'welcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('products', 'Product\ProductController');

Route::namespace('Cart')->prefix('my-cart')->as('carts.')->group(function(){
    Route::get('/', 'CartController@show')->name('show');
    Route::post('/{product}', 'CartController@store')->name('store');
    Route::delete('/{rowId}', 'CartController@destroy')->name('destroy');
    Route::post('/switchToWishList/{rowId}', 'CartController@switchToWishList')->name('switchtowishlist');
    Route::put('/{rowId}', 'CartController@update')->name('update');
    Route::delete('/', 'CartController@empty')->name('empty');
});

Route::namespace('Cart')->prefix('my-wish-list')->as('wishlist.')->group(function(){
    Route::get('/', 'WishListController@show')->name('show');
    Route::post('/{product}', 'WishListController@store')->name('store');
    Route::delete('/{rowId}', 'WishListController@destroy')->name('destroy');
    Route::delete('/', 'WishListController@empty')->name('empty');
});

Route::post('colors', 'ColorController@index')->name('colors.index');
