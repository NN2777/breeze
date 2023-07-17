<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Fungsi;
use App\Models\Answer;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function show(Request $request, $userid, $taskid)
    {   
        $answer = Answer::where([['user_id', $userid],['task_id', $taskid]])->first();
        $fungsi = Fungsi::where('answer_id', $answer->id)->get();
        $task = Task::where('id', $taskid)->first();
        // return view('show', compact('task', 'fungsi'));
        return view('show', compact('answer', 'fungsi', 'task'));
    }

    public function getData($id)
    {
        $task = Task::where('id', $id)->first();
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
        $data = Task::find($id); // <<<<<<<<<<<<<<<<<<<<<<<<<< disini

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
        $data = Task::find($id);

        $data->data = json_encode($jsonData);
        $data->save();

        // return response()->json(['data' => $data]);
        return response()->json(['success' => true]);
    }

    public function delJsonData(Request $request, $id)
    {
        $jsonData = $request->input('jsonData');

        // Save the data to the database
        $data = Task::find($id);

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
    public function create(Request $request, $id)
    {
        $task = new Task();
        $task->question = $request->input('question');
        $task->topic_id = $id;
        $tasknoLength = Task::where('topic_id', $id)->count();
        $task->task_no = $tasknoLength + 1;
        $task->save();

        $users = User::all();
        // dd($task->id);
        $taskid = $task->id;
        // Loop through users and create Answer records
        foreach ($users as $user) {
            $answer = new Answer();
            $answer->user_id = $user->id;
            $answer->task_id = $taskid;
            $answer->name_class = "myclass";
            $answer->data = json_encode([
                [
                    "id" => 1,
                    "nodetype" => "Start",
                    "parameter" => ""
                ],
                [
                    "id" => 2,
                    "nodetype" => "End",
                ],
            ]);
            $answer->save();
        }


        return redirect()->route('topic', ['id' => $id]);
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

    // public function getDownload(Request $request) {
    //     // prepare content
    //     // $logs = Log::all();
    //     // $content = "Logs \n";
    //     // foreach ($logs as $log) {
    //     //   $content .= $logs->id;
    //     //   $content .= "\n";
    //     // }
    //     $content = "cok";
    //     // file name that will be used in the download
    //     $fileName = "logs.txt";
    
    //     // use headers in order to generate the download
    //     $headers = [
    //       'Content-type' => 'text/plain', 
    //       'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
    //       'Content-Length' => strlen($content)
    //     ];
    
    //     // make a response, with the content, a 200 response code and the headers
    //     return Response::make($content, 200, $headers);
    // }

    // public function getDownload(Request $request) {
    //     // prepare content
    //     // $logs = Log::all();
    //     $codes = $request->input('code'); // Assuming $codes is an array
    //     // $codes = ["code1", "code2", "code3"];
    //     $content = "";
    //     // return response()->json(['success' => true, 'code' => $codes[5]['code']]);

    //     foreach ($codes as $code) {
    //         $content .= $code['code'];
    //         $content .= "\n";
    //     }

    //     // file name that will be used in the download
    //     $fileName = "logs.txt";
    
    //     // use headers in order to generate the download
    //     $headers = [
    //       'Content-type' => 'text/plain', 
    //       'Content-Disposition' => 'attachment; filename="'.$fileName.'"',
    //       'Content-Length' => strlen($content),
    //     ];
    
    //     // make a response, with the content, a 200 response code and the headers
    //     return response()->streamDownload(function () use ($content) {
    //         echo $content;
    //     }, 'logs.txt', ['Content-Type' => 'text/plain']);
    //     // return response($content, 200)->header('Content-Type', 'text/plain');
    // }
    public function getDownload(Request $request){
        $code = "class HelloWorld {\n    public static void main(String[] args) {\n        System.out.println(\"Hello, World!\");\n    }\n}";
        $fileName = 'code.txt';
    
        return response($code)
            ->header('Content-Disposition', 'attachment; filename=' . $fileName)
            ->header('Content-Type', 'text/plain');
    }
    // public function getDownload(Request $request) {
    //     // prepare content
    //     // $logs = Log::all();
    //     $codes = $request->input('code'); // Assuming $codes is an array
    //     // $codes = ["code1", "code2", "code3"];
    //     return response()->json(['success' => true, 'code' => $codes[]['code']]);

    //     $content = '';
    //     $content = implode("\n", $codes['code']);

    //     // File name for download
    //     $fileName = "codes.txt";

    //     // Content-Type header
    //     $headers = [
    //         'Content-type' => 'text/plain',
    //         'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
    //         'Content-Length' => strlen($content)
    //     ];

    //     // Generate the download response
    //     return response($content, 200, $headers);
    // }
}
