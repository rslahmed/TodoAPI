<?php

namespace App\Http\Controllers;

use App\Models\Todos;
use Illuminate\Http\Request;

class TodosController extends Controller
{

    public function index()
    {
        $todos = Todos::all();
        return response()->json($todos);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
           'title' => 'required|string',
           'completed' => 'required|boolean',
        ]);

        Todos::create($data);
        return response(201);
    }

    public function show($id)
    {
        $todo = Todos::find($id);
        return response()->json($todo);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'string',
            'completed' => 'boolean',
        ]);
        Todos::findOrFail($id)->update($data);
        return response(201);

    }

    public function destroy($id)
    {
        Todos::where('id',$id)->delete();
        return response(201);
    }

    public function checkAll(){
        Todos::query()->update([
            'completed' => request()->completed
        ]);
        return response(201);
    }

    public function clearCompleted(Request $request){
        Todos::destroy($request->ids);
        return response(201);
    }
}
