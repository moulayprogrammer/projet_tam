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
use App\Daira;
use App\Baladia;
Route::get('/', function () {
    return view('Les pages.page_principale');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cv', 'HomeController@cv')->middleware('auth');
Route::get('/demend_de_emp', 'HomeController@demend_de_emp')->middleware('auth');

Route::get('/travaille', 'travailleController@travaille');
Route::post('/travaille', 'travailleController@travaille');
Route::post('/recherche_travaille','travailleController@recherche_travaille' );
Route::get('/show_demend/{id}', 'travailleController@show_demend')->middleware('auth');

Route::post('/uploaded', 'HomeController@uploaded');

Route::get('/employes', 'employesController@employes');
Route::post('/employes', 'employesController@employes');
Route::get('/show_cv/{id}', 'employesController@show_cv')->middleware('auth');
Route::post('/recherche_employes','employesController@recherche_employes');

Route::get('/personel', 'personelController@personel')->middleware('auth');
Route::get('/page_principale', 'HomeController@page_principale');



Route::get('/ajaxDaira',function(){
	$wil_id= $_GET['wil'];
	$BD_daira=Daira::where('id_wilaya','=',$wil_id)->get();
	return Response::json($BD_daira);
});

Route::get('/ajaxCommune',function(){
	$daira_id= $_GET['daira'];
	$BD_commune=Baladia::where('id_daira','=',$daira_id)->get();
	return Response::json($BD_commune);
});

Route::GET('admin/home','AdminController@index')->name('admin.home');
Route::POST('admin','Admin\LoginController@login');
Route::GET('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::POST('logout','Admin\LoginController@logout')->name('logout');
Route::POST('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::GET('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::POST('admin-password/reset','Admin\ResetPasswordController@reset');
Route::GET('admin-password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::POST('admin/register','Admin\RegisterController@register');
Route::GET('admin/register','Admin\RegisterController@showRegistrationForm')->name('admin.register');
Route::get('register_today_list','AdminController@show_registered_today')->name('show_registered_today_list');
//facebook login

Route::get('login/facebook', 'Auth\LoginController@redirectToProvider')->name('facebook');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
