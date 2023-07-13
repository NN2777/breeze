<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function getData($id)
    {
        $task = Answer::where('id', $id)->first();
        $parseddata = json_decode($task);
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
        $data = Answer::find($id); // <<<<<<<<<<<<<<<<<<<<<<<<<< disini

        // $dataId = "FalseBranch_5_1";
        // $property = "nodetype";
        // $parts = explode("_", $dataId); // Split the text string by underscores
        
        $updatedFlowchart = json_encode($updatedData);

        $data->data = $updatedFlowchart;
        $data->save();
        return response()->json(['success' => true]);
    }

    public function addJsonData(Request $request, $id)
    {
        $jsonData = $request->input('jsonData');

        // Save the data to the database
        $data = Answer::find($id);

        $data->data = json_encode($jsonData);
        $data->save();

        // return response()->json(['data' => $data]);
        return response()->json(['success' => true]);
    }

    public function delJsonData(Request $request, $id)
    {
        $jsonData = $request->input('jsonData');

        // Save the data to the database
        $data = Answer::find($id);

        $data->data = json_encode($jsonData);
        $data->save();

        // return response()->json(['data' => $data]);
        return response()->json(['success' => true]);
    }
}
