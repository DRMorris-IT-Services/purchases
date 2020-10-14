<?php

Route::group(['namespace' => 'duncanrmorris\purchases\Http\Controllers'], function()
{
    Route::group(['middleware' => ['web', 'auth']], function(){
        
        #### PURCHASES MODUEL ####
        Route::get('purchases', 'PurchasesController@index')->name('purchases');
        Route::get('purchases/new', 'PurchasesController@create')->name('purchases.new');
        Route::get('purchases/edit/{id}', 'PurchasesController@edit')->name('purchases.edit');
        Route::put('purchases/update/{id}', 'PurchasesController@update')->name('purchases.update');
        Route::get('purchases/view/{id}', 'PurchasesController@show')->name('purchases.view');
        Route::put('purchases/crm-del/{id}', 'PurchasesController@destroy')->name('purchases.del');
        Route::get('purchases/download/{id}','PurchasesController@downloadPDF')->name('purchases.download');
        ### PURCHASES LINES ###
        Route::put('purchases/ln-update/{id}/{iid}', 'PurchasesLinesController@update')->name('purchases.ln.update');
        Route::get('purchases/ln-net/{id}', 'PurchasesLinesController@create')->name('purchases.ln.new');
   

    });
});