<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\apiController;
use App\Http\controllers\DemandesController;
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

//Route::get('/articles',[apiController::class,'getAllArticles']);
Route::get('/articles',[apiController::class,'getVisibleArticles']);
Route::get('/articles/{id}',[apiController::class,'getArticleById']);
Route::get('/articles/desc',[apiController::class,'getOrderedArticles']);
Route::get('/article/latest',[apiController::class,'getLatestArticle']);

//
Route::get('/events',[apiController::class,'getVisibleEvents']);
Route::get('/events/{id}',[apiController::class,'getEventById']);

Route::get('/filiers',[apiController::class,'getAllFiliers']);
Route::get('/filiers/active',[apiController::class,'getActiveFiliers']);
Route::get('/filiers/{id}',[apiController::class,'getFilierById']);
Route::get('/secteur/filiers',[apiController::class,'getGroupediliers']);
Route::get('/secteur/{id}',[apiController::class,'getFiliersBySecteurs']);
Route::get('/secteurs',[apiController::class,'getAllSeteurs']);

Route::get('/tags',[apiController::class,'getAllTags']);

Route::get('/categories',[apiController::class,'getAllcategories']);

Route::POST('/demande/send',[DemandesController::class,'store'])->name('demandes.send');
