<?php
Route::middleware(['guest'])->group(function () {
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('/register', 'Auth\RegisterController@register')->name('register');
    Route::get('/login', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@preLogin')->name('login');
    Route::get('/subscription', 'StripePaymentController@stripe')->name('stripe');
    Route::post('/subscription', 'StripePaymentController@stripePost')->name('stripe.post');
    Route::post('/password/recover', 'Auth\RegisterController@register')->name('recover.password');
});
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/xero/module/{class}','Admin\Xero\XeroController@index');