<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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

Route::get('/', [EmailController::class,'index']);
Route::get('/create', [EmailController::class,'create'])->name('create');
Route::get('/test',function (){
    $columns = Schema::getColumnListing('emails');
    dump($columns);
} );

Auth::routes();
