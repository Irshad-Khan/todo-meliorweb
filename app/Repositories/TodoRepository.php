<?php

namespace App\Repositories;

use App\Contracts\TodoInterface;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoRepository implements TodoInterface
{
    /**
     * Return all user todos
     */
    public function index()
    {
        return Todo::where('user_id',Auth::id())->paginate();
    }

    /**
     * Store new user todo
     */
    public function store($request)
    {
        return Todo::create($request->merge(['user_id' => Auth::id()])->all());
    }

    /**
     * Return todo for editing
     */
    public function edit($id)
    {
        return Todo::findOrFail($id);
    }

    /**
     * Update Todo data
     */
    public function update($request, $id)
    {
        return Todo::findOrFail($id)->update($request->all());
    }

    /**
     * Delete Todo
     */
    public function delete($id)
    {
        Todo::findOrFail($id)->delete();
    }
}
