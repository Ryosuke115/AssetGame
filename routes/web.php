<?php

use Illuminate\Support\Facades\Route;
use App\Events\TaskAdded;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/code', 'CodeController@index');//->middleware('checktime');

Route::get('code/add', 'CodeController@add');
Route::post('code/add', 'CodeController@ate');

Route::get('asset/menu', 'AssetController@asset_menu');
Route::get('/asset/host', 'AssetController@hostview');
Route::post('/asset/host', 'AssetController@assetcreate');

Route::get('/code/form', 'CodeController@codeview');
Route::post('/code/form', 'CodeController@codecreate');

Route::get('/gekijou', 'GekijouController@gekijou_view');


Route::get('/asset/mikan', 'CodeController@mikan_view');
Route::post('/asset/mikan', 'CodeController@mikan_stock');


Route::get('market', 'MarketController@review');
Route::post('market', 'MarketController@market_to');

Route::get('asset/invest', 'AssetController@asset_invest_market');
Route::post('asset/invest', 'AssetController@asset_codecreate');

Route::get('dividend', 'FiscalController@dividend_view');