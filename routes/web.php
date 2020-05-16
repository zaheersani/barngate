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

// Route::get('/', function () {
//     return view('welcome');
// });


//Vistas Dinamicas
Route::get('/', 'HomeController@index')->name("home");

//Login, Logout, Register
Auth::routes(["register" => false]);
Route::post('/register', 'UsersController@createRegistro')->name('registro.create');
Route::post('/ajaxLogin', 'UsersController@ajaxLogin')->name('ajaxLogin');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook'); //by vv
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookCallback'); //by vv

Route::get('login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('callback/google', 'Auth\LoginController@handleGoogleCallback');

//Sale
Route::get('/sale', 'SaleController@create')->name('sale');
Route::post('/sale.store', 'SaleController@store')->name('sale.store');
Route::post('/searchState', 'SaleController@SearchState')->name('sale.state');
Route::post('/animal_config', 'SaleController@SearchAnimal')->name('search.animal');
Route::get('/plan/{id}', 'SaleController@updatePlan')->name('sale.updateplan');
Route::post('/update/plan/{id}', 'SaleController@PageUpdatePlan')->name('sale.pageupdateplan');
Route::get('/edit/{id}', 'SaleController@edit')->name("sale.edit");
Route::post('/removeImgEdit', 'SaleController@removeImgEd')->name("sale.remove-img");
Route::post('/update/{id}', 'SaleController@update')->name("sale.update");


//Myaccount
Route::get('/my-account', 'MyaccountController@index')->name('myaccount');
Route::post('/myaccount/editProfile', 'MyaccountController@EditProfile')->name('editprofile');
Route::post('/saveSettings', 'MyaccountController@SaveSettings')->name('SaveSettings');
Route::post('saveImgMyaccount', 'MyaccountController@SaveImgMyaccount')->name('saveimgmyaccount');
Route::post('/myaccount/removeAnimal', 'MyaccountController@removeAnimal')->name('RemoveAnimal');
Route::post('/postagain', 'MyaccountController@PostAgain')->name("postagain");
Route::get('/score/{sale_id}/{calificado_id}', 'MyaccountController@scoreQualify')->name('sale.score');

//Qualify
Route::post('/addqualifyl', 'MyaccountController@qualify')->name('qualify');
Route::post('/addqualifyform', 'MyaccountController@qualifyForm')->name('qualifyForm');
Route::post('/addqualifylOther', 'MyaccountController@addqualifylOther')->name('addqualifylOther');


//Detalle
Route::get('/detail/{id}', 'SaleController@show')->name('sale.show');

//Favorites
Route::post("/addFavorite", "FavoritesController@addFavorite")->name("addFav");

//Search
Route::get('/search/{category}', 'SearchController@VistaSearch')->name('vistaSearch');
Route::post('/searcha', 'SearchController@SerchAjax')->name('serchajax');

//Contact
Route::post('/contact_send', 'HomeController@ContactSend')->name('contact.send');


//Chat
Route::get('/chat/{user_id}', 'ChatController@index')->name('chat.index');
Route::post('/messageSend', 'ChatController@messagesChat')->name("message.send");


//Vistas estaticas
Route::get('/notifications', 'PageEstaticController@showNotifications')->name('notifications');
Route::get('/faqs', 'PageEstaticController@showFaqs')->name('faqs');
Route::get('/privacy-policy', 'PageEstaticController@showPrivacy')->name('privacy');
Route::get('/about', 'PageEstaticController@showAbout')->name('about');
Route::get('/contact-us', 'PageEstaticController@showContact')->name('contact');


Route::get('/clear-cache', function () {
	Artisan::call('cache:clear');
	Artisan::call('config:clear');
	Artisan::call('config:cache');
	Artisan::call('view:clear');
	return "Cache is cleared";
});