<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Answer;
use App\Models\Task;
use App\Models\User;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taskIds = Task::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();
        
        $data = [];

        foreach ($taskIds as $taskId) {
            foreach ($userIds as $userId) {
                $data[] = [
                    'user_id' => $userId,
                    'task_id' => $taskId,
                    'name_class' => 'myclass',
                    'data' => json_encode([
                        [
                            'id' => 1,
                            'nodetype' => 'Start',
                        ],
                        [
                            'id' => 2,
                            'nodetype' => 'End',
                        ],
                    ]),
                ];
            }
        }
        foreach ($data as $element) {
            Answer::create([
                'task_id' => $element['task_id'],
                'user_id' => $element['user_id'],
                'name_class' => $element['name_class'],
                'data' => $element['data'],
            ]);
        }
    }
}
