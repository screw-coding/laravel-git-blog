<?php

use App\Http\Controllers\HomeController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [HomeController::class, 'index']);

Route::get('feed.xml', [HomeController::class, 'feed']);
Route::get('feed', [HomeController::class, 'feed']);
Route::get('blog/{blogId}.html', [HomeController::class, 'blog']);
Route::get('page/{pageNo}.html', [HomeController::class, 'page']);
Route::get('category/{categoryId}/page/{pageNo}.html', [HomeController::class, 'category']);
Route::get('category/{categoryId}.html', [HomeController::class, 'category']);
Route::get('tags/{tagId}/page/{pageNo}.html', [HomeController::class, 'tags']);
Route::get('tags/{tagId}.html', [HomeController::class, 'tags']);
Route::get('archive/{yearMonthId}/page/{pageNo}.html', [HomeController::class, 'archive']);
Route::get('archive/{yearMonthId}.html', [HomeController::class, 'archive']);
Route::get("search", [HomeController::class, 'search']);
Route::any("export", [HomeController::class, 'exportSite']);
Route::get("wp2gb", [HomeController::class, 'wp2Gb']);
Route::fallback([HomeController::class, 'go404']);
