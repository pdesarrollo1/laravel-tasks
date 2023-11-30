<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TasksController;
/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
    Route::get('/home', HomeController::class)->name('home');
Route::controller(TasksController::class)->group(function () {
    Route::get('tasks/completed', 'IndexCompleted')->name('completed.index')->middleware('auth');
    Route::put('tasks/completed/{task}', 'StoreCompleted')->name('completed.store')->middleware('auth');
    Route::post('filter', 'Filter')->name('tasks.filter');
});
Route::resource('tasks', TasksController::class)->middleware('auth'); //Esto sirve para hacer un CRUD con todas sus rutas el resource
Route::controller(LoginController::class)->group(function () {
    Route::get('signup', 'SignupIndex')->name('signup')->middleware('guest');
    Route::post('signup', 'SignupStore')->name('signup.store')->middleware('guest');
    Route::post('logout', 'SessionDestroy')->name('logout')->middleware('auth');
    Route::get('signin', 'SigninIndex')->name('login')->middleware('guest');
    Route::post('signin', 'SigninStore')->name('login.store')->middleware('guest');
});

Route::controller(SessionsController::class)->group(function(){
    Route::get('sessions', 'index')->name('session.index')->middleware('auth');
    Route::post('sessions', 'store')->name('session.store')->middleware('auth');;
});
});


