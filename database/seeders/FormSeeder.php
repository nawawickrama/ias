<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\SubForm;
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
            ['name' => 'AAF', 'payment' => '400'],
            ['name' => 'LGO', 'payment' => '540']
        ];

        foreach ($forms as $form){
            Form::create([
                'form_name' => $form['name'],
                'payment' => $form['payment']
            ]);
        }

        $subForms =[
            //step -aaf
            ['course_id' => '1', 'form_id' => 1, 'price' => 1450],
            //e-step -aaf
            ['course_id' => '2', 'form_id' => 1, 'price' => 1380],
            //mep -aaf
            ['course_id' => '3', 'form_id' => 1, 'price' => 1180],
            //pap -aaf
            ['course_id' => '4', 'form_id' => 1, 'price' => 2580],
            //gvet -aaf
            ['course_id' => '5', 'form_id' => 1, 'price' => 1000],
            //direct job -aaf
            ['course_id' => '6', 'form_id' => 1, 'price' => 1380],
        ];

        foreach ($subForms as $sub){
            SubForm::create([
                'course_id' => $sub['course_id'],
                'form_id' => $sub['form_id'],
                'price' => $sub['price'],
            ]);
        }
    }
}
