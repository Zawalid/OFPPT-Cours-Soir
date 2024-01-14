<?php

use App\Models\Evenement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementsController;
use App\Http\Controllers\FiliersController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\generalController;
use App\Http\Controllers\admin\TestController;

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

Route::get('/addAF',[generalController::class,'insertAFandCtegories']);
Route::get('/admin/settings',[generalController::class,'getAf'])->name('settings.index');
Route::POST('/admin/settings/setActiveInSession',[generalController::class,'setActivInSession'])->name('ChangerAfSession');
Route::POST('/admin/settings/setActiveAF',[generalController::class,'setActiveAF'])->name('setActiveAF');

Route::get('admin', function () {
    return view('articles');
    // return redirect('admin/articles');
});

Route::get('admin/articles/trash', [ArticlesController::class,'trash'])->name('articles.trash');
Route::POST('admin/articles/cacher/{id}', [ArticlesController::class,'cacher'])->name('articles.cacher');
Route::get('admin/articles/restore/{id}', [ArticlesController::class,'restore'])->name('articles.restore');
Route::delete('admin/articles/force_delete/{id}', [ArticlesController::class,'forceDelete'])->name('articles.force_delete');
Route::resource('admin/articles', ArticlesController::class)->middleware('auth');


Route::get('admin/evenements/trash', [EvenementsController::class,'trash'])->name('evenements.trash');
Route::POST('admin/evenements/cacher/{id}',[EvenementsController::class,'cacher'])->name('evenements.cacher');
Route::get('admin/evenements/restore/{id}', [EvenementsController::class,'restore'])->name('evenements.restore');
Route::delete('admin/evenements/force_delete/{id}', [EvenementsController::class,'forceDelete'])->name('evenements.force_delete');
Route::resource('admin/evenements', EvenementsController::class)->middleware('auth');



Route::get('admin/filiers/trash', [FiliersController::class,'trash'])->name('filiers.trash');
Route::POST('admin/filiers/cacher/{id}', [FiliersController::class,'cacher'])->name('filiers.cacher');
Route::get('admin/filiers/restore/{id}', [FiliersController::class,'restore'])->name('filiers.restore');
Route::delete('admin/filiers/force_delete/{id}', [FiliersController::class,'forceDelete'])->name('filiers.force_delete');
Route::resource('admin/filiers', FiliersController::class)->middleware('auth');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
