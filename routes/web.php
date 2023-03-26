<?php

use Illuminate\Support\Facades\App;
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

Auth::routes();



// route data library
use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index'])->name('home');

// route crud catalog
use App\Http\Controllers\CatalogController;

// saat menggunakan route() perlu name sedangkan saat menggunakan url() tidak perlu
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/catalog/create', [CatalogController::class, 'create']);
Route::post('/catalog/store', [CatalogController::class, 'store']);
Route::get('/catalog/edit/{id}', [CatalogController::class, 'edit']);
Route::put('/catalog/update/{id}', [CatalogController::class, 'update']);
Route::delete('/catalog/delete/{id}', [CatalogController::class, 'destroy']);

// route crud catalog
use App\Http\Controllers\AuthorController;

Route::get('/author', [AuthorController::class, 'index'])->name('author');
Route::get('/author/create', [AuthorController::class, 'create']);
Route::post('/author/store', [AuthorController::class, 'store']);
Route::get('/author/edit/{id}', [AuthorController::class, 'edit']);
Route::put('/author/update/{id}', [AuthorController::class, 'update']);
Route::delete('/author/delete/{id}', [AuthorController::class, 'destroy']);

// route crud book
use App\Http\Controllers\BookController;

Route::resource('/book', BookController::class);
// get data api from yajra datatables
Route::get('/api/book', [BookController::class, 'books_api']);

// route crud  detail book
Route::get('/detail_book', [BookController::class, 'detail_books']);
Route::get('/detail_book/show/{id}', [BookController::class, 'show']);
Route::get('/api/detail_book', [BookController::class, 'detail_books_api']);

//route crud publiser 
use App\Http\Controllers\PublisherController;

Route::get('/api/publisher', [PublisherController::class, 'publishers_api']);
Route::resource('/publisher', PublisherController::class);


//route crud transaction
use App\Http\Controllers\TransactionController;
Route::get('/api/transaction', [TransactionController::class, 'getApi']);
Route::resource('/transaction', TransactionController::class);