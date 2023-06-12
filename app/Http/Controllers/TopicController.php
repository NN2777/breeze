<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Models\PdfFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TopicController extends Controller
{
    public function getTaskData(Request $request, $id)
    {
        $data = DB::table('tasks')->where('topic_id', $id)->get();
        // dd($data);
        $parseddata = json_decode($data);
        return response()->json($parseddata);
        // $dataarray = json_decode($data, true);

        // return view('calldata', ['dataaray' => $dataarray]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $topic = Topic::where('id', $id)->first();
        $pdfFiles = PdfFile::where('topic_id', $id)->get();
        // $pdfFiles = PdfFile::get();
        // dd($pdfFiles);
        return view('topic', compact('topic', 'pdfFiles'));
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
    public function store(StoreTopicRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        //
    }

    public function uploadPDF(Request $request)
    {
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048', // Validation rules for the PDF file
        ]);

        if ($request->file('pdf_file')) {
            $pdfContent = file_get_contents($request->file('pdf_file')->getPathname());

            $model = new PdfFile(); // Replace 'ModelName' with the actual model you're using
            // $model->pdf_file = $pdfContent;            
            $model->pdf_file = $request->file('pdf_file')->storeAs('pdf_file', $request->input('file_name') . '.pdf');
            $model->topic_id = $request->input('topic_id');
            $model->file_name = $request->input('file_name');

            // dd($model);

            $model->save();

            return 'PDF uploaded successfully.';
        }

        return 'No PDF file selected.';
    }

    public function downloadPDF($id)
    {
        $model = PdfFile::find($id); // Replace 'ModelName' with the actual model you're using

        if ($model) {
            // $file = $model->pdf_file;
            // $fileName = 'file.pdf'; // Set the default file name
            // // Retrieve the actual file name from the model or any other source
            // // Replace the following line with the appropriate code to get the file name
            // if ($model->file_name) {
            //     $fileName = $model->file_name;
            // }

            // // Set the appropriate headers for the file download
            // $headers = [
            //     'Content-Type' => 'application/pdf',
            //     'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            // ];

            // return response()->streamDownload(function () use ($file) {
            //     echo $file;
            // }, $fileName, $headers);
            return Storage::download($model->pdf_file);
        }

        return 'PDF not found.';
    }
}
