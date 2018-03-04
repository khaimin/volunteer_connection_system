<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/register', ['as'=>'register', 'uses'=>'RegisterController@register']);
Route::post('/register', ['as'=>'register.save', 'uses'=>'RegisterController@saveregister']);
Route::post('/logout',['as'=>'logout','uses'=>'RegisterController@logout']);

Route::get('/redirectdvtn-{email}', ['as'=>'redirect.dvtn', 'uses'=>'RegisterController@redirectdvtn']);
Route::get('/redirectqtv-{email}', ['as'=>'redirect.qtv', 'uses'=>'RegisterController@redirectqtv']);

Route::get('/', ['as'        =>'index','uses'=>'MapController@index']);
Route::get('/skds', ['as'=>'indexds', 'uses'=>'MapController@indexds']);
Route::get('/dvtn/{IDDV}', ['as' 	=>'dvtn', 'uses'=>'MapController@dvtn']);
Route::get('/dvtnoldevent', ['as'=>'oldevent-dvtn', 'uses'=>'MapController@oldeventdvtn']);
Route::get('/dssk/{IDDV}', ['as'=>'dssk', 'uses'=>'MapController@dssk']);
Route::get('/sk/{IDSK}', ['as' 	=>'sk', 'uses'=>'MapController@sk']);

//Đăng ký sự kiện
Route::get('sk/dk/{IDSK}', ['as'=>'dk.sk', 'uses'=>'DKSKController@dksk'])->middleware('CheckUserTV');
Route::get('sk/huy/{IDSK}', ['as'=>'huy.sk','uses'=>'DKSKController@huysk'])->middleware('CheckUserTV');
Route::get('/indexfollow', ['as'=>'indexfollow', 'uses'=>'MapController@indexfollow']);

// thong tin tv
Route::get('/tv', ['as'=>'tv.info', 'uses'=>'TVController@tvinfo'])->middleware('CheckUserTV');
//end thong tin tv

//tìm kiếm
Route::get('/timdv', ['as'=>'timtheodv', 'uses'=>'MapController@timtheodv']);
Route::get('/timtg', ['as'=>'timtheotg', 'uses'=>'MapController@timtheotg']);
Route::post('/timbk', ['as'=>'timtheobk', 'uses'=>'MapController@timtheobk']);

//end tìm kiếm

// ============================================================================

Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'dvtn'],function(){
		Route::get('/', ['as'=>'admin.dvtn.index', 'uses'=>'DVTNController@index'])->middleware('CheckUserDVTN');
		Route::get('/edit/{IDDV}', ['as'=>'admin.dvtn.edit', 'uses'=>'DVTNController@edit'])->middleware('CheckUserDVTN');
		Route::post('/edit/{IDDV}', ['as'=>'admin.dvtn.update', 'uses'=>'DVTNController@update'])->middleware('CheckUserDVTN');
	});

	Route::group(['prefix'=>'sk'],function(){ 
		Route::get('/', ['as'=>'admin.dvtn.sk.index', 'uses'=>'SKController@index'])->middleware('CheckUserDVTN');
		Route::get('/infosk/{IDSK}', ['as'=>'admin.dvtn.sk.infosk', 'uses'=>'SKController@infosk'])->middleware('CheckUserDVTN');
		Route::get('/create', ['as'=>'admin.dvtn.sk.create', 'uses'=>'SKController@create'])->middleware('CheckUserDVTN');
		Route::post('/create', ['as'=>'admin.dvtn.sk.store', 'uses'=>'SKController@store'])->middleware('CheckUserDVTN');
		Route::get('/edit/{IDSK}', ['as'=>'admin.dvtn.sk.edit', 'uses'=>'SKController@edit'])->middleware('CheckUserDVTN');
		Route::post('/edit/{IDSK}', ['as'=>'admin.dvtn.sk.update', 'uses'=>'SKController@update'])->middleware('CheckUserDVTN');
		Route::get('/del/{IDSK}', ['as'=>'admin.dvtn.sk.del', 'uses'=>'SKController@destroy'])->middleware('CheckUserDVTN');
		Route::get('/oldsk', ['as'=>'admin.dvtn.sk.oldsk', 'uses'=>'SKController@oldsk'])->middleware('CheckUserDVTN');
// ds da dang ky sk
		Route::get('/dadk-{IDSK}', ['as'=>'admin.dvtn.sk.dadk', 'uses'=>'SKController@dadk'])->middleware('CheckUserDVTN');
		Route::get('/excell/{IDSK}', ['as'=>'excell', 'uses'=>'SKController@exportExcell'])->middleware('CheckUserDVTN');

	});

	//quản lý của qtv, xem thông tin tv, dvtn, sk và duyệt các thông tin đó
	Route::group(['prefix'=>'qtv'], function(){
		// Route::get('/', ['as'=>'admin.qtv.index', 'uses'=>'AdminController@index']);
		Route::group(['prefix'=>'tv'], function(){
			Route::get('/', ['as'=>'admin.qtv.tv.index', 'uses'=>'AdminController@tvindex'])->middleware('CheckAdmin');
			Route::get('/{IDTV}', ['as'=>'admin.qtv.tv.info', 'uses'=>'AdminController@tvinfo'])->middleware('CheckAdmin');
			Route::get('del/{IDTV}', ['as'=>'admin.qtv.tv.del', 'uses'=>'AdminController@tvdel'])->middleware('CheckAdmin');
		});
		Route::group(['prefix'=>'dvtn'], function(){
			Route::get('/', ['as'=>'admin.qtv.dvtn.index', 'uses'=>'AdminController@dvtnindex'])->middleware('CheckAdmin');
			Route::get('/{IDDV}', ['as'=>'admin.qtv.dvtn.info', 'uses'=>'AdminController@dvtninfo'])->middleware('CheckAdmin');
			Route::get('/edit/{IDDV}', ['as'=>'admin.qtv.dvtn.edit', 'uses'=>'AdminController@dvtnedit'])->middleware('CheckAdmin');
			Route::post('/edit/{IDDV}', ['as'=>'admin.qtv.dvtn.update', 'uses'=>'AdminController@dvtnupdate'])->middleware('CheckAdmin');
			Route::get('/del/{IDDV}', ['as'=>'admin.qtv.dvtn.del', 'uses'=>'AdminController@dvtndestroy'])->middleware('CheckAdmin');
		});
		Route::group(['prefix'=>'sk'], function(){
			Route::get('/', ['as'=>'admin.qtv.sk.index', 'uses'=>'AdminController@skindex'])->middleware('CheckAdmin');
			Route::get('/{IDSK}', ['as'=>'admin.qtv.sk.info', 'uses'=>'AdminController@skinfo'])->middleware('CheckAdmin');
			Route::get('/edit/{IDSK}', ['as'=>'admin.qtv.sk.edit','uses'=>'AdminController@skedit'])->middleware('CheckAdmin');
			Route::post('/edit/{IDSK}', ['as'=>'admin.qtv.sk.update','uses'=>'AdminController@skupdate'])->middleware('CheckAdmin');
			Route::get('/del/{IDSK}', ['as'=>'admin.qtv.sk.del', 'uses'=>'AdminController@skdestroy'])->middleware('CheckAdmin');

		});

	});

});
Route::auth();

Route::get('/home', 'HomeController@index');
