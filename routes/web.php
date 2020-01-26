<?php

use Illuminate\Support\Facades\Hash;

Auth::routes();

Route::get('/test', function () {

    $ss =Hash::make('password');

    return $ss;
});

Route::get('/', function () {
    return redirect('admin/home');
});

Route::group(['prefix'=> 'admin', 'middleware' => 'auth'], function () {

Route::resource('users', 'UsersController');

Route::get('/users/admin/{id}', 'UsersController@admin')->name('users.admin');

//Route::get('/user/profile', 'ProfileController@index')->name('user.profile');

Route::get('/user/profile/{id}', 'UsersController@profile')->name('user.profile.update');

Route::put('/user/profile/{id}', 'UsersController@updateprofile')->name('updateprofile');

Route::delete('/user/delete/{id}', 'UsersController@destroy');

Route::get('/users/not-admin/{id}', 'UsersController@not_admin')->name('users.not_admin');

Route::put('/users/reset-password/{id}', 'UsersController@resetPassword')->name('users.reset');



Route::get('/home', [
    'uses' => 'HomeController@index',
    'as' =>'home'
]);

Route::resource('groups','GroupsController');

Route::resource('members','MembersController');

Route::get('/export', 'MembersController@export')->name('export');

Route::get('/addmember', 'MembersController@add')->name('addMember');

//Route::post('/addmember', 'MembersController@store')->name('singleMember');

Route::post('/import', 'MembersController@import')->name('import');

});
