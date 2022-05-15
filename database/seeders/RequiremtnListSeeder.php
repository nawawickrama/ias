<?php

namespace Database\Seeders;

use App\Models\RequirementList;
use Illuminate\Database\Seeder;

class RequiremtnListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [
            ['name' => 'Student Information', 'model' => 'App\Models\Student', 'type' => 'Document'],
            ['name' => 'Required Documents', 'model' => 'App\Models\Student', 'type' => 'Document'],
            ['name' => 'AAF form', 'model' => 'App\Models\Student', 'type' => 'Form'],
            ['name' => 'LGO form', 'model' => 'App\Models\Student', 'type' => 'Form'],
            ['name' => 'Admission Payment', 'model' => 'App\Models\Student', 'type' => 'Payment'],
        ];

        foreach ($list as $data){
            RequirementList::create([
                'name' => $data['name'],
                'model' => $data['model'],
                'type' => $data['type'],
            ]);
        }
    }
}
