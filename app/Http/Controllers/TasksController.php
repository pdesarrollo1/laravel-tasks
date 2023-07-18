<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    //Funcion para la pagina principal esta es la convencion index
    public function index()
    {
        $tasks = Task::where('user_id', auth()->user()->id)
            ->where('completed', false)
            ->orderBy('id', 'desc')
            ->paginate();
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
        $task->save();

        return redirect()->route('tasks.show', $task->id); //podemos pasar solo $task
    }

    //Funcion para mostrar los datos esta es la convencion show
    public function show(Task $task)
    {
        return view('tasks.show', compact('task')); //De esta forma se recupera con el mismo nombre de la variable
    }

    public function update(Request $request, Task $task) //  Laravel entiende que quiero que ese $id sea una instancia de la clase Task cuyo id sea lo que le estoy pasando por URL
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
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
