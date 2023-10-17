<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::latest()->get();

        return response([
            'message' => 'success',
            'todos' => TodoResource::collection($todos),
        ], 200);
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
    public function store(TodoRequest $todoRequest)
    {
        $todoRequest->validated();

        $saveData =  Todo::create([
            'text' => $todoRequest->text,
            'completed' => 0,
        ]);

        if ($saveData) {
            return response([
                'message' => 'success',
                'todo' => new TodoResource($saveData),
            ], 201);
        } else {
            return response([
                'message' => 'error',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
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
    public function update(Request $todoRequest, Todo $todo)
    {
        // $todoRequest->validated();

        $updatedData = $todo->update([
            'text' => empty($todoRequest->text) ? $todo->text : $todoRequest->text,
            'completed' => $todo->completed == 1 ? 0 : 1,
        ]);

        if ($updatedData) {
            return response([
                'message' => 'success',
                'todo' => $updatedData,
            ], 200);
        } else {
            return response([
                'message' => 'error',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($todo)
    {
        if (Todo::find($todo->id)) {
            $deleted = Todo::where('id', $todo)->deleted();

            if ($deleted) {
                return response([
                    'message' => 'success',
                    'todo' => $deleted,
                ], 200);
            } else {
                return response([
                    'message' => 'error',
                ], 500);
            }
        } else {
            return response([
                'message' => '404',
            ], 500);
        }
    }
}
