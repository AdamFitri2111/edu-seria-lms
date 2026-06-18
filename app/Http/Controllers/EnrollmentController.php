<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->enrolledCourses()
                        ->withPivot('progress', 'status')
                        ->get();

        return view('enrollments.index', compact('courses'));
    }

    public function store(Course $course)
    {
        $exists = Enrollment::where('user_id', auth()->id())
                            ->where('course_id', $course->id)
                            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah mendaftar kursus ini.');
        }

        Enrollment::create([
            'user_id'   => auth()->id(),
            'course_id' => $course->id,
            'progress'  => 0,
            'status'    => 'active',
        ]);

        return back()->with('success', 'Berjaya mendaftar ke kursus!');
    }

    public function destroy(Course $course)
    {
        Enrollment::where('user_id', auth()->id())
                  ->where('course_id', $course->id)
                  ->delete();

        return back()->with('success', 'Anda telah keluar dari kursus.');
    }
}