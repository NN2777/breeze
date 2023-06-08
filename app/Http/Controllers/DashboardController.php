<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Task;
use App\Models\Topic;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // $topic = Topic::all();
        // // dd($topic);

        return view('dashboard');
        // return view('layout.app', compact('topic'));
    }

    // public function getData(Request $request)
    // {
    //     $data = Material::orderBy('task_no')->get();

    //     return response()->json([
    //         'data' => $data,
    //     ]);
    // }

    public function getData($id)
    {
        $data = Task::where('topic_id', $id)->orderBy('task_no', 'asc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('task_no', function ($data) {
                return ($data->task_no);
            })
            ->addColumn('question', function ($data) {
                return ($data->question);
            })
            ->addColumn('aksi', function ($data) {
                return '
                <div class="btn-group">
                    <a href="' . route('show.page', $data->id) . '" class="btn btn-xs btn-info btn-flat">Show</a>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
