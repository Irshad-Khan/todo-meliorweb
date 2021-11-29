<?php

namespace App\Repositories;

use App\Contracts\TodoInterface;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoRepository implements TodoInterface
{
    public function index()
    {
        return Todo::where('user_id',Auth::id())->paginate();
    }

    public function store($request)
    {
        return Todo::create($request->merge(['user_id' => Auth::id()])->all());
    }

    public function edit($id)
    {
        return Todo::findOrFail($id);
    }

    public function update($request, $id)
    {
        return Todo::findOrFail($id)->update($request->all());
    }

    public function delete($id)
    {
        Todo::findOrFail($id)->delete();
    }
}
