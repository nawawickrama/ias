<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course_details = [
            'STEP' => ['code' => 'STEP', 'name' => 'Study Eligibility Program', 'description' => 'Pre-bachelors program for students who completed
            their 12 yrs of Schooling'],

            'E-STEP' => ['code' => 'E-STEP', 'name' => 'English - Study Eligibility Program', 'description' => 'Pre-bachelors program for students who
            completed their 12 yrs of Schooling'],

            'MEP' => ['code' => 'MEP', 'name' => 'Master Eligibility Program', 'description' => 'Pre- Master program for students who wish to start
            their Masters In Germany'],

            // 'PAP' => ['code' => 'PAP', 'name' => 'Master Eligibility Program', 'description' => 'German license preparation program for foreign nurses seeking jobs in Germany'],

            // 'GVET' => ['code' => 'GVET', 'name' => 'Master Eligibility Program', 'description' => ''],
            
            'Direct job' => ['code' => 'Direct job', 'name' => 'Technical and IT fields', 'description' => 'Technical and IT fields'],
        ];

        foreach($course_details as $course){
            Course::create([
                'course_name' => $course['name'],
                'course_code' => $course['code'],
                'course_status' => 1,
                'course_description' => $course['description'],
            ]);
        }
    }
}
