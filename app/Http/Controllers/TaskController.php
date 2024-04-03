<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $tasks = Task::where('title', 'like', '%'.$searchTerm.'%')
                    ->orWhere('description', 'like', '%'.$searchTerm.'%')
                    ->orWhere('category', 'like', '%'.$searchTerm.'%')
                    ->orWhere('due_date', 'like', '%'.$searchTerm.'%')
                    ->get();

        return view('tasks.index', compact('tasks'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
        ]);

        // Guardar los datos en la base de datos
        $task = Task::create($validatedData);

        // Devolver una respuesta JSON indicando el éxito de la operación y los datos de la tarea
        return response()->json(['success' => true, 'task' => $task]);
    }

    public function destroy($id)
    {
        // Encontrar la tarea por su ID
        $task = Task::findOrFail($id);
    
        // Eliminar la tarea
        $task->delete();
    
        // Devolver una respuesta JSON indicando el éxito de la operación
        return response()->json(['success' => true]);
    }
}
