<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\DrinkOrderController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/bots', [BotController::class, 'index'])->name('bots.index');
Route::get('/bots/create', [BotController::class, 'create'])->name('bots.create');
Route::post('/bots/store', [BotController::class, 'store'])->name('bots.store');

Route::get('/bots/workflow/{id}', [BotController::class, 'workflow'])->name('bot.workflow');
Route::post('/bots/workflow/store', [BotController::class, 'workflowStore'])->name('bot.workflow.store');
Route::post('/bots/workflow/ai/store', [BotController::class, 'workflowStoreAi'])->name('bot.workflow.ai.store');
