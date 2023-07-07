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
                        "nodetype" => "Assign",
                        "name" => "x",
                        "value" => "19",
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
                        "variable" => "x",
                        "operator" => "==",
                        "value" => 20,
                        "nodetype" => "Selection",
                        "TrueBranch" => [
                            [
                                "id" => 1,
                                "nodetype" => "Declare",
                                "name" => "z",
                                "dtype" => "String",
                            ],
                            [
                                "id" => 2,
                                "nodetype" => "Declare",
                                "name" => "j",
                                "dtype" => "String",
                            ],
                            [
                                "id" => 3,
                                "variable" => "xdsf",
                                "operator" => "==",
                                "value" => 20,
                                "nodetype" => "Selection",
                                "TrueBranch" => [
                                        [
                                            "id" => 1,
                                            "nodetype" => "Declare",
                                            "name" => "z222",
                                            "dtype" => "String",
                                        ],
                                        [
                                            "id" => 2,
                                            "nodetype" => "Declare",
                                            "name" => "asdfj",
                                            "dtype" => "String",
                                        ], 
                                    ],
                                    "FalseBranch" => [
                                        [
                                        "id" => 1,
                                        "nodetype" => "Declare",
                                        "name" => "n",
                                        "dtype" => "String",
                                        ],
                                    ],
                                ],
                                [
                                    "id" => 4,
                                    "nodetype" => "Declare",
                                    "name" => "jejejey",
                                    "dtype" => "String",
                                ],
                        ],
                        "FalseBranch" => [
                            [
                            "id" => 1,
                            "nodetype" => "Declare",
                            "name" => "n",
                            "dtype" => "String",
                            ],
                        ],
                    ],
                    [
                        "id" => 7,
                        "nodetype" => "End",
                    ],
                ])
                ],
            [
                    'topic_id' => 8,
                    'task_no' => 1,
                    'question' => 'Sebuah sistem dibuat untuk menentukan pakaian dan peralatan yang harus
                    dibawa pengguna sesuai dengan kondisi cuaca. Jika suhu lebih dari 27oC, maka
                    pengguna disarankan memakai dress, kemudian dilakukan pengecekan apakah
                    saat ini hujan, jika hujan maka pengguna disarankan untuk membawa payung,
                    sedangkan jika tidak hujan maka pengguna disarankan untuk memakai sunscreen.
                    Namun, jika suhu kurang dari atau sama dengan 27oC, maka pengguna disarankan
                    memakai celana panjang',
                    'name_class' => 'myclass',
                    'data' =>  json_encode([
                        [
                            "id" => 1,
                            "nodetype" => "Start",
                        ],
                        [
                            "id" => 2,
                            "nodetype" => "Declare",
                            "name" => "suhu",
                            "dtype" => "int",
                        ],
                        [
                            "id" => 3,
                            "nodetype" => "Declare",
                            "name" => "hujan",
                            "dtype" => "char",
                        ],
                        [
                            "id" => 4,
                            "nodetype" => "Input",
                            "name" => "suhu",
                            "prompt" => "Masukkan",
                        ],
                        [
                            "id" => 5,
                            "nodetype" => "Input",
                            "name" => "hujan",
                            "prompt" => "Masukkan",
                        ],
                        [
                            "id" => 6,
                            "variable" => "suhu",
                            "operator" => ">",
                            "value" => 27,
                            "nodetype" => "Selection",
                            "TrueBranch" => [
                                [
                                    "id" => 1,
                                    "nodetype" => "Output",
                                    "prompt" => "Memakai Dress",
                                ],
                                [
                                    "id" => 2,
                                    "variable" => "hujan",
                                    "operator" => "equals",
                                    "value" =>"y",
                                    "nodetype" => "Selection",
                                    "TrueBranch" => [
                                            [
                                                "id" => 1,
                                                "nodetype" => "Output",
                                                "prompt" => "Membawa payung",
                                            ],
                                        ],
                                    "FalseBranch" => [
                                            [
                                                "id" => 1,
                                                "nodetype" => "Output",
                                                "prompt" => "Memakai sunscreen",
                                            ],
                                        ],
                                    ],
                            ],
                            "FalseBranch" => [
                                [
                                    "id" => 1,
                                    "nodetype" => "Output",
                                    "prompt" => "Memakai celana panjang",
                                ],
                            ],
                        ],
                        [
                            "id" => 7,
                            "nodetype" => "End",
                        ],
                    ])
                    ],
                    [
                        'topic_id' => 8,
                        'task_no' => 2,
                        'question' => 'Sistem ATM mempunyai 3 menu yaitu Penarikan, Transfer, dan Ubah Pin
                        ⮚Pada menu Penarikan, pengguna diminta memilih jenis tabungan “Giro” atau
                        “Deposito”, kemudian memasukkan jumlah uang yang akan diambil
                        ⮚Pada menu Transfer, pengguna diminta untuk memilih kode bank tujuan yang terdiri
                        dari BRI, BNI, Mandiri, Bukopin, dan BCA, kemudian memasukkan rekening tujuan,
                        dan memasukkan jumlah uang yang akan ditransfer
                        ⮚Pada menu Ubah Pin, pengguna diminta untuk memasukkan password lama dan
                        password baru
                        Buatlah flowchart untuk sistem ATM tersebut!',
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
                                "nodetype" => "Assign",
                                "name" => "x",
                                "value" => "19",
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
                                "variable" => "x",
                                "operator" => "==",
                                "value" => 20,
                                "nodetype" => "Selection",
                                "TrueBranch" => [
                                    [
                                        "id" => 1,
                                        "nodetype" => "Declare",
                                        "name" => "z",
                                        "dtype" => "String",
                                    ],
                                    [
                                        "id" => 2,
                                        "nodetype" => "Declare",
                                        "name" => "j",
                                        "dtype" => "String",
                                    ],
                                    [
                                        "id" => 3,
                                        "variable" => "xdsf",
                                        "operator" => "==",
                                        "value" => 20,
                                        "nodetype" => "Selection",
                                        "TrueBranch" => [
                                                [
                                                    "id" => 1,
                                                    "nodetype" => "Declare",
                                                    "name" => "z222",
                                                    "dtype" => "String",
                                                ],
                                                [
                                                    "id" => 2,
                                                    "nodetype" => "Declare",
                                                    "name" => "asdfj",
                                                    "dtype" => "String",
                                                ], 
                                            ],
                                            "FalseBranch" => [
                                                [
                                                "id" => 1,
                                                "nodetype" => "Declare",
                                                "name" => "n",
                                                "dtype" => "String",
                                                ],
                                            ],
                                        ],
                                        [
                                            "id" => 4,
                                            "nodetype" => "Declare",
                                            "name" => "jejejey",
                                            "dtype" => "String",
                                        ],
                                ],
                                "FalseBranch" => [
                                    [
                                    "id" => 1,
                                    "nodetype" => "Declare",
                                    "name" => "n",
                                    "dtype" => "String",
                                    ],
                                ],
                            ],
                            [
                                "id" => 7,
                                "nodetype" => "End",
                            ],
                        ])
                    ],
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