<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TasksController;
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

Route::get('/home', HomeController::class)->name('home');
Route::resource('tasks', TasksController::class)->middleware('auth'); //Esto sirve para hacer un CRUD con todas sus rutas el resource

Route::controller(LoginController::class)->group(function () {
    Route::get('signup', 'SignupIndex')->name('signup')->middleware('guest');
    Route::post('signup', 'SignupStore')->name('signup.store')->middleware('guest');
    Route::post('logout', 'SessionDestroy')->name('logout')->middleware('auth');
    Route::get('signin', 'SigninIndex')->name('login')->middleware('guest');
    Route::post('signin', 'SigninStore')->name('login.store')->middleware('guest');
});


//Rutas Individuales
// Route::get('tasks', [TasksController::class, 'index']);

// Route::get('tasks/create', [TasksController::class, 'create']);

// Route::get('tasks/{id}', [TasksController::class, 'show']);

//Grupo de rutas
// Route::controller(TasksController::class)->group(function () {
//     Route::get('tasks',  'index')->name('tasks.index');

//     Route::get('tasks/create', 'create')->name('tasks.create');

//     Route::post('tasks/create', 'save')->name('tasks.save');

//     Route::get('tasks/{task}', 'show')->name('tasks.show');
    
//     Route::put('tasks/{task}', 'update')->name('tasks.update');

//     Route::delete('tasks/{task}', 'destroy')->name('task.destroy');

// });


// Si queremos cambiar la URL pero manteniendo el nombre de las rutas:

// Route::resource('asignaturas', TaskController::class)->name('cursos');
//       Ahora el nombre de las variables usarán 'asignatura' y para cambiar esto:

// Route::resource('asignaturas', TaskController::class)
// 	->parameters('asignaturas' => 'curso')
// 	->name('cursos');
//Ruta Con parametros
// Route::get('ruta/{parametro}', function ($parametro) {
//     return "Lo que se va a retornar y se puede usar el parametro $parametro";
// });
