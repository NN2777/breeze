<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fungsi;

class FunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =  [
            [
                'task_id' => 1,
                'function_name' => "func1",
                'function_type' => 'void',
                'data' =>  json_encode([
                    [
                        "id" => 1,
                        "nodetype" => "Start",
                    ],
                    [
                        "id" => 2,
                        "nodetype" => "Declare",
                        "name" => "y",
                        "dtype" => "String",
                    ],
                    [
                        "id" => 3,
                        "nodetype" => "Assign",
                        "name" => "y",
                        "value" => "55",
                    ],
                    [
                        "id" => 4,
                        "nodetype" => "Input",
                        "name" => "x",
                        "prompt" => "Masukkan nilai",
                    ],
                    [
                        "id" => 5,
                        "nodetype" => "Output",
                        "prompt" => "x = 19",
                    ],
                    [
                        "id" => 6,
                        "nodetype" => "End",
                    ],
                ])
                ],
                [
                    'task_id' => 1,
                    'function_name' => "func2",
                    'function_type' => 'int',
                    'data' =>  json_encode([
                        [
                            "id" => 1,
                            "nodetype" => "Start",
                        ],
                        [
                            "id" => 2,
                            "nodetype" => "Declare",
                            "name" => "YTEAMMM",
                            "dtype" => "String",
                        ],
                        [
                            "id" => 3,
                            "nodetype" => "Assign",
                            "name" => "yTEAMMM",
                            "value" => "55",
                        ],
                        [
                            "id" => 4,
                            "nodetype" => "Input",
                            "name" => "YTEAMMM",
                            "prompt" => "Masukkan nilai",
                        ],
                        [
                            "id" => 5,
                            "nodetype" => "Output",
                            "prompt" => "x = 19",
                        ],
                        [
                            "id" => 6,
                            "nodetype" => "End",
                        ],
                    ])
                    ],
                    [
                        'task_id' => 2,
                        'function_name' => "func1",
                        'function_type' => 'int',
                        'data' =>  json_encode([
                            [
                                "id" => 1,
                                "nodetype" => "Start",
                            ],
                            [
                                "id" => 2,
                                "nodetype" => "Declare",
                                "name" => "JMASD",
                                "dtype" => "String",
                            ],
                            [
                                "id" => 3,
                                "nodetype" => "Assign",
                                "name" => "JASF",
                                "value" => "55",
                            ],
                            [
                                "id" => 4,
                                "nodetype" => "Input",
                                "name" => "ASFGG",
                                "prompt" => "Masukkan nilai",
                            ],
                            [
                                "id" => 5,
                                "nodetype" => "Output",
                                "prompt" => "x = 19",
                            ],
                            [
                                "id" => 6,
                                "nodetype" => "End",
                            ],
                        ])
                        ],
        ];

        foreach ($data as $element) {
            Fungsi::create([
                'task_id' => $element['task_id'],
                'function_name' => $element['function_name'],
                'function_type' => $element['function_type'],
                'data' => $element['data'],
            ]);
        }
    }
}
