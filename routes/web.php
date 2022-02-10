<?php

use App\Http\Controllers\LogTestController;
use App\Service\LogReader;
use Illuminate\Support\Facades\Route;

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

// Route::get('/logs', [LogTestController::class, 'logViewer']);
Route::get('/eventlog', [LogTestController::class, 'eventLogWrite']);

Route::get('/custom-logger', [LogTestController::class, 'getLog']);
Route::get('/log-viewer', [LogTestController::class, 'logViewer']);