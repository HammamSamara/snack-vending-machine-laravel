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
Route::get('/', 'VendingMachineController@index');

// @request->code
Route::post('selectsnack', 'VendingMachineController@selectSnack');
// @request->amount
Route::post('insertmoney', 'VendingMachineController@insertMoney');

// sends report to manager
Route::get('sendemail', 'MailController@send');

Route::group(['prefix' => 'orders'], function(){
    Route::get('', 'OrderController@index');
    Route::get('today', 'OrderController@getTodaysOrders');
    Route::get('frequent', 'OrderController@mostPopularSnack');
    Route::get('success', 'OrderController@getSucceededOrders');
    Route::get('avg', 'OrderController@getTodaysAvgSalePerDay');
    Route::get('totalsales', 'OrderController@totalSales');
    Route::get('sales', 'OrderController@totalSalePerSnack');

});


Route::group(['prefix' => 'snacks'], function(){
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    Route::get('not_available', 'SnackController@needsRefill');
    Route::resource('', 'SnackController');
});