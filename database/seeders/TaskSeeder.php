<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =  [
            [
                'topic_id' => 1,
                'task_no' => 1,
                'question' => 'Buatlah flowchart cara menghitung segitiga menggunakan data tipe integer dan double',
                'name_class' => 'myclass',
                'data' =>  json_encode([
                    [
                        "id" => 1,
                        "nodetype" => "Start",
                    ],
                    [
                        "id" => 2,
                        "nodetype" => "Declare",
                        "name" => "x",
                        "dtype" => "String",
                    ],
                    [
                        "id" => 3,
                        "nodetype" => "Input",
                        "name" => "x",
                        "prompt" => "Masukkan nilai",
                    ],
                    [
                        "id" => 4,
                        "nodetype" => "Output",
                        "prompt" => "x = 19",
                    ],
                    [
                        "id" => 5,
                        "nodetype" => "End",
                    ],
                ])
            ]
        ];


        foreach ($data as $element) {
            Task::create([
                'topic_id' => $element['topic_id'],
                'task_no' => $element['task_no'],
                'question' => $element['question'],
                'name_class' => $element['name_class'],
                'data' => $element['data'],
            ]);
        }
    }
}
