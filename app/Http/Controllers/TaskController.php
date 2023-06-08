<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function show(Request $request, $id)
    {
        $task = Task::where('id', $id)->first();
        return view('show', compact('task'));
    }

    public function getData($id)
    {
        $task = Task::where('topic_id', $id)->first();
        // dd($data);
        $parseddata = json_decode($task);
        return response()->json($parseddata);
        // $dataarray = json_decode($data, true);

        // return view('calldata', ['dataaray' => $dataarray]);
    }

    public function updateData(Request $request)
    {
        $dataId = (int) $request->input('dataId'); // The ID of the data object being updated
        $property = $request->input('property'); // The property name to be updated
        $value = $request->input('value'); // The updated value

        // Retrieve the data from the database        
        $data = Task::find(1);
        $flowchart = json_decode($data->data);

        foreach ($flowchart as &$item) {
            foreach ($item as $key => &$datadata) {
                if ($item->id === $dataId && $key === $property) {
                    $item->$key = $value;
                    break;
                }
            }
        }

        $data->data = json_encode($flowchart);

        $data->save();

        return response()->json(['success' => true]);
    }

    public function addJsonData(Request $request)
    {
        $jsonData = $request->input('jsonData');

        // Save the data to the database
        $data = Task::find(1);

        $data->data = json_encode($jsonData);
        $data->save();

        // return response()->json(['data' => $data]);
        return response()->json(['success' => true]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreTaskRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
