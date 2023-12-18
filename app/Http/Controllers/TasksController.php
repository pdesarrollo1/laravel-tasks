<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check()) {

                // $tenants = DB::table('tenants')->get();
                $tenants = DB::table('laravel_tasks.tenant_users')
                    ->select('laravel_tasks.tenant_users.global_user_id', 'laravel_tasks.tenants.data', 'laravel_tasks.tenants.id AS tenant')
                    ->join('laravel_tasks.tenants', 'tenants.id', '=', 'tenant_users.tenant_id')
                    ->where('tenant_users.global_user_id', '=', auth()->user()->global_id)
                    ->get();
                // dd($tenants);
                foreach ($tenants as $tenant) {
                    $databaseName = json_decode($tenant->data)->tenancy_db_name;
                    $name = "database.connections." . $databaseName;
                    // Configurar la conexión de base de datos para el inquilino actual
                    config([
                        $name => [
                            'driver' => 'mysql',
                            'database' => $databaseName,
                            'host' => env('DB_HOST', '127.0.0.1'),
                            'port' => env('DB_PORT', '3306'),
                            'username' => env('DB_USERNAME', 'forge'),
                            'password' => env('DB_PASSWORD', ''),
                        ],
                    ]);
                }
            }

            return $next($request);
        });
    }
    //Funcion para la pagina principal esta es la convencion index
    public function index()
    {
        // dd(auth()->user());

        // $tasks = Task::where('user_id', auth()->user()->id)
        //     ->where('completed', false)
        //     ->orderBy('id', 'desc')
        //     ->paginate();
        // $tasks = Task::all();
        // return $tasks;

        // $tasks = DB::table('tenantbar.tasks')
        //     ->select('tenantbar.tasks.*')
        //     ->get();
        $userTenants = DB::table('laravel_tasks.tenant_users')
        ->select('laravel_tasks.tenant_users.global_user_id', 'laravel_tasks.tenants.data', 'laravel_tasks.tenants.id AS tenant')
        ->join('laravel_tasks.tenants', 'tenants.id', '=', 'tenant_users.tenant_id')
        ->where('tenant_users.global_user_id', '=', auth()->user()->global_id)
        ->get();
        
        $tasks = [];
        foreach($userTenants as $item){
            $database = json_decode($item->data)->tenancy_db_name;
            $tenant = $item->tenant;
            // $userTasks = DB::table($database . '.tasks')
            // ->select('*')
            // ->where('global_user_id', auth()->user()->global_id)
            // ->where('completed', false)
            // ->orderBy('id', 'desc')
            // ->get();
            $userTasks = Task::on($database)
            ->select('*')
            ->where('global_user_id', auth()->user()->global_id)
            ->where('completed', false)
            ->orderBy('id', 'desc')
            ->get();
            $userTasks = $userTasks->map(function ($task) use ($tenant) {
                $task->tenant = $tenant;
                return $task;
            });
            foreach($userTasks as $userTask){
              array_push($tasks, $userTask);
            }
          }
        // return $tasks;
        // $tenants = Tenant::all();
        // return $tenants;
        return view('tasks.index', compact('tasks'));
    }

    //Funcion para la creacion de datos algo como un formulario esta es la convencion create
    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        //Validacion para agregar mas de una se usa | 
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);


        //Asi se guarda un registro en la BD,
        // $task = new Task();
        // $task->title = $request->title;
        // $task->description = $request->description;
        // $task->save();
        // se puede reemplazar por una asignacion masiva, sólo esta línea de código:

        $task = new Task;
        $task->fill($request->all());
        $task->user_id = auth()->id(); // Asignar el ID del usuario autenticado
        $task->global_user_id = auth()->user()->global_id; // Asignar el ID del usuario autenticado
        $task->save();
        return redirect()->route('tasks.index'); //podemos pasar solo $task
    }

    //Funcion para mostrar los datos esta es la convencion show
    public function show($task, $tenant)
    {
        $database = 'tenant'.$tenant;
        $task = Task::on($database)->find($task);
        $task->tenant = $tenant;
        return view('tasks.show', compact('task')); //De esta forma se recupera con el mismo nombre de la variable
    }

    public function update(Request $request, $task) //  Laravel entiende que quiero que ese $id sea una instancia de la clase Task cuyo id sea lo que le estoy pasando por URL
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $database = 'tenant'.$request->tenant;
        $task = Task::on($database)->find($task);
        $task->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('tasks.index');
    }

    public function destroy( $task)
    {
        $database = 'tenant'.request()->tenant;
        $task = Task::on($database)->find($task);
        $task->delete();
        return redirect()->route('tasks.index');
    }

    public function StoreCompleted(Task $task)
    {
        $task->update([
            'completed' => true
        ]);
        return redirect()->route('tasks.index');
    }
    public function IndexCompleted()
    {
        $tasks = Task::where('user_id', auth()->user()->id)
            ->where('completed', true)
            ->orderBy('updated_at', 'desc')
            ->paginate();
        return view('tasks.completed', compact('tasks'));
    }

    public function Filter(Request $request)
    {
        $data = $request->get('data');
        $data = intval($data);
        $option = $request->get('filterOptions');
        $option = intval($option);
        if ($data == 0) {
            $completed = false;
        } else {
            $completed = true;
        }
        switch ($option) {
            case 0:
                return redirect()->route('tasks.index');
            case 1:
                $tasks = Task::where('user_id', auth()->user()->id)
                    ->where('completed', $completed)
                    ->where('is_important', false)
                    ->orderBy('id', 'desc')
                    ->paginate();
                return view('tasks.index', compact('tasks'));
            case 2:
                $tasks = Task::where('user_id', auth()->user()->id)
                    ->where('completed', $completed)
                    ->where('is_important', true)
                    ->orderBy('id', 'desc')
                    ->paginate();
                return view('tasks.index', compact('tasks'));
        }
    }

    //Funcion para mostrar los datos esta es la convencion show
    // public function showExample($id)
    // {
    //     // return "Aca se muestran dichas tareas $id"; //Cuando se vaya a utilizar el parametro se utilizan comillas dobles("")
    //     //Formas de mandar la variable
    //     // return view('tasks.show', ['id' => $id]); //De esta forma asigandole el nombre con el cual quiero que se 

    //     // $task = Task::find($id); //Trae el registro con ese id
    //     // return view('tasks.show', compact('task')); //De esta forma se recupera con el mismo nombre de la variable
    // }

}
