<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Fungsi;
use App\Models\Answer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FungsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $fungsi = Fungsi::where('id', $id)->first();
        $answer = Answer::where('id', $fungsi->answer_id)->first();
        $fungsiAll = Fungsi::where('answer_id', $fungsi->answer_id)->get();
        return view('funcshow', compact('fungsi', 'answer', 'fungsiAll'));
    }

    public function getAllFungsi(Request $request, $id)
    {
        $allfungsi = Fungsi::where('answer_id', $id)->get();
        return response()->json($allfungsi);
    }
    
    public function getTask(Request $request, $id)
    {
        $task = Task::where('id', $id)->first();
        return response()->json($task);
    }
    
    public function getData($id)
    {
        $fungsi = Fungsi::where('id', $id)->first();
        $parseddata = json_decode($fungsi);
        return response()->json($parseddata);
    }

    public function updateData(Request $request, $id) //ini update nanti tambahin id
    {
        // $dataId = $request->input('dataId'); // The ID of the data object being updated
        // $property = $request->input('property'); // The property name to be updated
        // $value = $request->input('value'); // The updated value
        $updatedData = $request->input('element'); // The updated value
        // return response()->json(['property' => $property, 'dataId' => $dataId, 'value'=>$value]);
        // Retrieve the data from the database        
        $data = Fungsi::find($id); // <<<<<<<<<<<<<<<<<<<<<<<<<< disini
        
        $updatedFlowchart = json_encode($updatedData);

        $data->data = $updatedFlowchart;
        $data->save();
        return response()->json(['success' => true]);
    }

    public function addJsonData(Request $request, $id)
    {
        $jsonData = $request->input('jsonData');

        // Save the data to the database
        $data = Fungsi::find($id);

        $data->data = json_encode($jsonData);
        $data->save();

        // return response()->json(['data' => $data]);
        return response()->json(['success' => true]);
    }

    public function delJsonData(Request $request, $id)
    {
        $jsonData = $request->input('jsonData');

        // Save the data to the database
        $data = Fungsi::find($id);

        $data->data = json_encode($jsonData);
        $data->save();

        // return response()->json(['data' => $data]);
        return response()->json(['success' => true]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $fungsi = new Fungsi();
        $fungsi->function_name = 'func';
        $fungsi->function_type = 'void';
        $fungsi->answer_id = $id;
        $fungsi->data = json_encode([
            [
                "id" => 1,
                "nodetype" => "Function",
                "name" => "func",
                "type" => "void",
            ],
            [
                "id" => 2,
                "nodetype" => "Return",
                "value" => "x",
            ],
        ]);
        $fungsi->save();

        return redirect()->route('fungsi.index', ['id' => $fungsi->id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $fungsi = Fungsi::where('task_id', $id)->first();
    //     return view('show', compact('task'));
    // }

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Fungsi::find($id);
        $index = Answer::find($data->answer_id);

        $data->delete();

        return redirect()->route('answer.index', ['id' => $index->id]);
        // return response()->json(['data' => $data]);
        // return response()->json(['success' => true, 'message' => 'Data deleted successfully.']);
    }
}
