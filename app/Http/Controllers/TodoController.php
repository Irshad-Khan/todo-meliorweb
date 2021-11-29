<?php

namespace App\Http\Controllers;

use App\Contracts\TodoInterface;
use App\Http\Requests\TodoStoreRequest;
use App\Http\Requests\TodoUpdateRequest;
use App\Http\Resources\TodoResource;
use Illuminate\Http\Request;
use stdClass;

class TodoController extends Controller
{
    protected $todoInterface;
    public function __construct(TodoInterface $todoInterface)
    {
        $this->todoInterface = $todoInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'Todos List',
            'data' => TodoResource::collection($this->todoInterface->index())
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoStoreRequest $request)
    {
        return response()->json([
            'status' => true,
            'message' => 'Todo created successfully',
            'data' => new TodoResource($this->todoInterface->store($request))
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json([
            'status' => true,
            'message' => 'Todo detail',
            'data' => new TodoResource($this->todoInterface->edit($id))
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodoUpdateRequest $request, $id)
    {
        $this->todoInterface->update($request, $id);
        return response()->json([
            'status' => true,
            'message' => 'Todo updated successfully',
            'data' => new stdClass
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->todoInterface->delete($id);
        return response()->json([
            'status' => true,
            'message' => 'Todo deleted successfully',
            'data' => new stdClass
        ], 204);
    }
}
