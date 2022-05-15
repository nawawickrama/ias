<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $forms = [
            ['name' => 'AAF'],
            ['name' => 'LGO']
        ];

        foreach ($forms as $form){
            Form::create([
                'form_name' => $form['name']
            ]);
        }
    }
}
