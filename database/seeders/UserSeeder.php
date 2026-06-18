<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Course;

class UserSeeder extends Seeder
{
    use App\Models\Course;

    public function run(): void
    {
        $educator = User::create([
            'name' => 'Dr. Ahmad Hakim',
            'email' => 'educator@eduSeria.com',
            'password' => Hash::make('password'),
            'role' => 'educator',
        ]);

        User::create([
            'name' => 'Nur Aisyah',
            'email' => 'learner@eduSeria.com',
            'password' => Hash::make('password'),
            'role' => 'learner',
        ]);

        $courses = [
            ['title' => 'Introduction to Cloud Computing', 'code' => 'CSC101', 'category' => 'Computer Science', 'level' => 'Beginner', 'status' => 'published', 'duration_weeks' => 6, 'description' => 'Learn the fundamentals of cloud computing including IaaS, PaaS, and SaaS.'],
            ['title' => 'Cybersecurity Fundamentals', 'code' => 'CSC205', 'category' => 'Computer Science', 'level' => 'Intermediate', 'status' => 'published', 'duration_weeks' => 8, 'description' => 'Understand core cybersecurity concepts and how to protect systems.'],
            ['title' => 'Web Development', 'code' => 'CSC109', 'category' => 'Computer Science', 'level' => 'Beginner', 'status' => 'published', 'duration_weeks' => 10, 'description' => 'Build modern web applications using HTML, CSS, JavaScript and Laravel.'],
            ['title' => 'Data Analytics Essentials', 'code' => 'DAT101', 'category' => 'Data Science', 'level' => 'Beginner', 'status' => 'published', 'duration_weeks' => 6, 'description' => 'Introduction to data analysis, visualization and basic statistics.'],
            ['title' => 'Mobile Application Development', 'code' => 'CSC301', 'category' => 'Computer Science', 'level' => 'Intermediate', 'status' => 'draft', 'duration_weeks' => 12, 'description' => 'Develop cross-platform mobile applications using modern frameworks.'],
        ];

        foreach ($courses as $course) {
            Course::create(array_merge($course, ['educator_id' => $educator->id]));
        }
    }
}