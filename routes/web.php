<?php

use App\Models\Evenement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvenementsController;
use App\Http\Controllers\FiliersController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DemandesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\TestController;


//settings routes
Route::get('/admin/settings',[HomeController::class,'getAf'])->name('settings.index');
Route::POST('/admin/settings/setActiveInSession',[HomeController::class,'setActivInSession'])->name('ChangerAfSession');
Route::POST('/admin/settings/setActiveAF',[HomeController::class,'setActiveAF'])->name('setActiveAF');

//articles routes
Route::get('admin/articles/trash', [ArticlesController::class,'trash'])->name('articles.trash');
Route::POST('admin/articles/cacher/{id}', [ArticlesController::class,'cacher'])->name('articles.cacher');
Route::get('admin/articles/restore/{id}', [ArticlesController::class,'restore'])->name('articles.restore');
Route::delete('admin/articles/force_delete/{id}', [ArticlesController::class,'forceDelete'])->name('articles.force_delete');
Route::resource('admin/articles', ArticlesController::class)->middleware('auth');


Route::get('admin/demandes/trash', [DemandesController::class,'trash'])->name('demandes.trash');
Route::get('admin/demandes/restore/{id}', [DemandesController::class,'restore'])->name('demandes.restore');
Route::resource('admin/demandes', DemandesController::class)->middleware('auth');

//evenements routes
Route::get('admin/evenements/trash', [EvenementsController::class,'trash'])->name('evenements.trash');
Route::POST('admin/evenements/cacher/{id}',[EvenementsController::class,'cacher'])->name('evenements.cacher');
Route::get('admin/evenements/restore/{id}', [EvenementsController::class,'restore'])->name('evenements.restore');
Route::delete('admin/evenements/force_delete/{id}', [EvenementsController::class,'forceDelete'])->name('evenements.force_delete');
Route::resource('admin/evenements', EvenementsController::class)->middleware('auth');

//filiers routes
Route::get('admin/filiers/trash', [FiliersController::class,'trash'])->name('filiers.trash');
Route::POST('admin/filiers/cacher/{id}', [FiliersController::class,'cacher'])->name('filiers.cacher');
Route::get('admin/filiers/restore/{id}', [FiliersController::class,'restore'])->name('filiers.restore');
Route::delete('admin/filiers/force_delete/{id}', [FiliersController::class,'forceDelete'])->name('filiers.force_delete');
Route::resource('admin/filiers', FiliersController::class)->middleware('auth');

//auth routes
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//admin
Route::middleware(['auth','role:super-admin|admin'])->group(function () {
    // users routes
    Route::resource('users', UsersController::class);
    Route::get('/users/trash',[UsersController::class,'trash'])->name('users.trash');
    Route::post('/user/{user}/roles', [UsersController::class, 'assignRole'])->name('users.roles');
    Route::delete('/user/{user}/roles/{role}', [UsersController::class, 'removeRole'])->name('users.roles.remove');
    Route::post('/user/{user}/permissions', [UsersController::class, 'givePermission'])->name('users.permissions');
    Route::delete('/user/{user}/permissions/{permission}', [UsersController::class, 'revokePermission'])->name('users.permissions.revoke');
    
    //permissions routes
    Route::resource('/permissions', PermissionController::class);
    Route::post('/permissions/assignRole/{permission}', [PermissionController::class, 'assignRole'])->name('permissions.roles');
    Route::delete('/permissions/removeRole/{permission}/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');

    //roles routes
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/givePermission', [RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/revokePermission/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');

}); 