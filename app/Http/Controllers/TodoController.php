<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Todo::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'List Todo',
            'data' => $result
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = Todo::create([
            'title' => $request->title
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'List created',
            'data' => $result
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Todo::find($id);
        return response()->json([
            'status' => 'success',
            'message' => 'show todo',
            'data' => $result
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = Todo::find($id);
        $complete = "";
        if ($request->complete) {
            $complete = $request->complete;
        } else if ($request->complete == 0) {
            $complete = "false";
        } else if ($request->complete == 1) {
            $complete = "false";
        }
        $result->update([
            'title' => $request->title,
            'complete' => $complete,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'List created',
            'data' => $result
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Todo::find($id);
        $result->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'List created',
            'data' => $result
        ]);
    }
}
