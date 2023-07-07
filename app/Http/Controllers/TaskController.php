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
        $task = Task::where('topic_id', $id)->first();
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
        $dataId = $request->input('dataId'); // The ID of the data object being updated
        $property = $request->input('property'); // The property name to be updated
        $value = $request->input('value'); // The updated value

        // return response()->json(['property' => $property, 'dataId' => $dataId, 'value'=>$value]);
        // Retrieve the data from the database        
        $data = Task::find(1);
        $flowchart = json_decode($data->data);

        // $dataId = "FalseBranch_5_1";
        // $property = "nodetype";
        $parts = explode("_", $dataId); // Split the text string by underscores
        $branch = $parts[0]; // "FalseBranch"
        $var1 = isset($parts[1]) ? intval($parts[1]) : null;
        $var2 = isset($parts[2]) ? intval($parts[2]) : null;
        // dd($dataId, $branch, $var1, $var2);
        // dd($flowchart[$var1 - 1]->$branch[$var2 - 1]->$property);

        if ($var1 !== null && $var2 !== null) {
            $flowchart[$var1 - 1]->$branch[$var2 - 1]->$property = $value;
        } else {
            $flowchart[intval($branch) - 1]->$property = $value;
        }
        
        $updatedFlowchart = json_encode($flowchart);

        $data->data = $updatedFlowchart;
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

    public function delJsonData(Request $request)
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
