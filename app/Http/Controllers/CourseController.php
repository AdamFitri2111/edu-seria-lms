<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isEducator()) {
            $courses = Course::where('educator_id', $user->id)
                            ->withCount('enrollments')
                            ->latest()->paginate(10);
        } else {
            $courses = Course::where('status', 'published')
                            ->withCount('enrollments')
                            ->latest()->paginate(10);
        }

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'code'           => 'required|string|unique:courses,code',
            'description'    => 'nullable|string',
            'category'       => 'required|string',
            'level'          => 'required|in:Beginner,Intermediate,Advanced',
            'status'         => 'required|in:draft,published,archived',
            'duration_weeks' => 'required|integer|min:1',
        ]);

        $validated['educator_id'] = auth()->id();

        Course::create($validated);

        return redirect()->route('courses.index')
                        ->with('success', 'Kursus berjaya ditambah!');
    }

    public function show(Course $course)
    {
        $course->load(['educator', 'learners']);
        $isEnrolled = false;

        if (auth()->user()->isLearner()) {
            $isEnrolled = $course->learners->contains(auth()->id());
        }

        return view('courses.show', compact('course', 'isEnrolled'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'code'           => 'required|string|unique:courses,code,' . $course->id,
            'description'    => 'nullable|string',
            'category'       => 'required|string',
            'level'          => 'required|in:Beginner,Intermediate,Advanced',
            'status'         => 'required|in:draft,published,archived',
            'duration_weeks' => 'required|integer|min:1',
        ]);

        $course->update($validated);

        return redirect()->route('courses.index')
                        ->with('success', 'Kursus berjaya dikemaskini!');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')
                        ->with('success', 'Kursus berjaya dipadam!');
    }
}