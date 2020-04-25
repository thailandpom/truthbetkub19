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
Route::get('/{page?}', 'FrontendController@index')->name('index');


Route::prefix('/api')->group(function () {

  Route::get('/getPage/{slug?}', array('middleware' => 'cors', 'uses' => 'FrontendApiController@getPage'));
  Route::get('/getContent/{slug?}', array('middleware' => 'cors', 'uses' => 'FrontendApiController@getContent'));
  Route::get('/getContact', array('middleware' => 'cors', 'uses' => 'FrontendApiController@getContact'));

});


Route::prefix('/backend')->group(function () {
  Auth::routes();

  Route::get('/dashboard', 'HomeController@index')->name('dashboard');

  Route::resource('pages', 'PagesController');
  Route::get('/pages/pages_destroy/{id?}', 'PagesController@destroy')->name('pages_destroy');
  Route::post('/pages/pages_update', 'PagesController@update')->name('pages_update');

  Route::resource('widget', 'WidgetController');
  Route::get('/pages/customize/{id?}', 'WidgetController@customize')->name('pages_customize');
  Route::get('/pages/create_widget/{id?}/{widgetType?}', 'WidgetController@create')->name('create_widget');
  Route::post('/pages/update_widget', 'WidgetController@update')->name('update_widget');
  Route::get('/pages/widget_destroy/{id?}', 'WidgetController@destroy')->name('widget_destroy');
  Route::post('/pages/widget/update_order', 'WidgetController@update_order')->name('update_order');

  Route::resource('contact', 'ContactController');
  Route::get('/contact/contact_destroy/{id?}', 'ContactController@destroy')->name('contact_destroy');
  Route::post('/contact/contact_update', 'ContactController@update')->name('contact_update');

  Route::resource('users', 'UserController');
  Route::get('/users/edit_profile/{id?}', 'UserController@edit_profile')->name('edit_profile');
  Route::get('/users/users_destroy/{id?}', 'UserController@destroy')->name('users_destroy');
  Route::post('/users/users_update', 'UserController@update')->name('users_update');
  Route::post('/users/update_profile', 'UserController@profile_store')->name('update_profile');
  
  Route::resource('settings', 'SettingController');
  Route::post('/settings/settings_update', 'SettingController@update')->name('settings_update');

  Route::get('/pages/image_slide/{page_id?}/{id?}', 'WidgetController@image_slide')->name('image_slide');
  Route::post('/pages/save_slide', 'WidgetController@save_slide')->name('save_slide');
  Route::post('/pages/update_slide', 'WidgetController@update_slide')->name('update_slide');
  Route::get('/pages/image_slide_destroy/{page_id?}/{id?}', 'WidgetController@image_slide_destroy')->name('image_slide_destroy');
  Route::post('/pages/update_order_silde', 'WidgetController@update_order_silde')->name('update_order_silde');
  Route::post('/pages/update_status', 'WidgetController@update_status')->name('update_status');
});

