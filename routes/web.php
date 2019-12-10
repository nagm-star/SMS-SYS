<?php

Route::get('/test', function () {
    return App\Profile::find(1)->user;
});


Auth::routes();


Route::get('/', function () {
    return redirect('admin/home');
});

Route::group(['prefix'=> 'admin', 'middleware' => 'auth'], function () {

Route::resource('users', 'UsersController');
Route::get('/users/admin/{id}', 'UsersController@admin')->name('users.admin');
Route::get('/user/profile', 'ProfileController@index')->name('user.profile');
Route::put('/user/profile/{id}', 'ProfileController@update')->name('user.profile.update');
Route::delete('/user/delete/{id}', 'usersController@destroy');
Route::get('/users/not-admin/{id}', 'UsersController@not_admin')->name('users.not_admin');

Route::get('/settings', 'SettingController@index');
Route::put('/setting/update', 'SettingController@update')->name('setting.update');;


Route::get('/home', [
    'uses' => 'HomeController@index',
    'as' =>'home'
]);


});

