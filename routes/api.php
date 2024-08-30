<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PorteFeuilleVirtuelController;
use App\Http\Controllers\TemoignageController;
use App\Http\Controllers\userController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::middleware('api')->group(function () { 
    Route::resource('transaction', TransactionController::class);         
}); 
Route::middleware('api')->group(function () { 
    Route::resource('portefeuilleVirtuelle', PorteFeuilleVirtuelController::class);         
}); 
Route::get('/transactions/limitbuy/{userID}', [TransactionController::class, 'getLimitBuy']);
Route::put('/transactions/setlimitbuy/{idtransaction}', [TransactionController::class, 'setLimitBuy']);
Route::get('/porteFeuille/getPortefeuilleUser/{idUser}', [PorteFeuilleVirtuelController::class, 'getPortefeuilleUser']);
Route::get('/porteFeuille/getPortefeuille/{id}', [PorteFeuilleVirtuelController::class, 'getPortefeuille']);

Route::put('/porteFeuille/setValeur/{id}/{val}', [PorteFeuilleVirtuelController::class, 'setValeur']);
Route::get('/transactions/getQuantiteParActifEtTypeTransaction/{porteFeuilleID}', [TransactionController::class, 'getQuantiteParActifEtTypeTransaction']);
Route::put('/porteFeuille/sell/{id}/{val}', [PorteFeuilleVirtuelController::class, 'sell']);

Route::put('/accepteTem/{id}', [TemoignageController::class, 'accepte']);
Route::put('/refuseTem/{id}', [TemoignageController::class, 'refuse']);
Route::get('/TemoiActive', [TemoignageController::class, 'tmoignageMain']);

Route::middleware('api')->group(function () {
    Route::resource('temoignages', TemoignageController::class);
});
Route::get('/nbreTemoi',[TemoignageController::class,'nbreElement']);
Route::get('/nbreTemoiActive',[TemoignageController::class,'nbreTemoiActive']);
Route::get('/nbreTemoiInactive',[TemoignageController::class,'nbreTemoiNonActive']);
Route::get('/nbreUser',[userController::class,'nbreElement']);
Route::get('/nbreTransactionMarketBuy',[TransactionController::class,'nbreTransactionMarketBuy']);
Route::get('/nbreTransactionLimitBuy',[TransactionController::class,'nbreTransactionLimitBuy']);
Route::get('/nbreTransaction',[TransactionController::class,'nbreTransaction']);

