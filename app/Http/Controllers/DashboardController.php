<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isEducator()) {
            $data = [
                'totalCourses'     => Course::where('educator_id', $user->id)->count(),
                'totalStudents'    => User::where('role', 'learner')->count(),
                'recentCourses'    => Course::where('educator_id', $user->id)
                                        ->withCount('enrollments')
                                        ->latest()->take(5)->get(),
            ];
        } else {
            $data = [
                'enrolledCourses'  => $user->enrolledCourses()->withPivot('progress')->get(),
                'totalEnrolled'    => $user->enrollments()->count(),
            ];
        }

        return view('dashboard', compact('user', 'data'));
    }
}