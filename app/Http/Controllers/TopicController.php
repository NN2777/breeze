<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

        return view('topic', compact('topic'));
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
}
