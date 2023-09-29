<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();

        if ($todos->isEmpty()) {
            return response()->json(['message' => 'No data found'], 404);
        }

        return response()->json(['message' => 'Todo list retrieved successfully', 'data' => $todos], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $todo = Todo::create($request->all());
        return response()->json(['message' => 'Todo created successfully', 'data' => $todo], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        if ($todo) {
            return response()->json(['message' => 'Todo retrieved successfully', 'data' => $todo], 200);
        } else {
            return response()->json(['message' => 'No data found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->update($request->all());
        return response()->json(['message' => 'Todo updated successfully', 'data' => $todo], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(['message' => 'Todo deleted successfully'], 204);
    }
}
