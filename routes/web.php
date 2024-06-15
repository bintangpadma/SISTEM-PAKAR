<?php

use App\Http\Controllers\DiagnosaController;
use App\Models\Gejala;
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
    $data = [
        'gejala' => Gejala::all(),
    ];
    return view('home', $data);
});

Route::resource('/spk', DiagnosaController::class);