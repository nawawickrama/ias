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
            ['name' => 'Student Information', 'model' => 'App\Models\Student'],
            ['name' => 'Required Documents', 'model' => 'App\Models\Student'],
            ['name' => 'AAF form', 'model' => 'App\Models\Student'],
            ['name' => 'LGO form', 'model' => 'App\Models\Student'],
            ['name' => 'Admission Payment', 'model' => 'App\Models\Student'],
        ];

        foreach ($list as $data){
            RequirementList::create([
                'name' => $data['name'],
                'model' => $data['model'],
            ]);
        }
    }
}
