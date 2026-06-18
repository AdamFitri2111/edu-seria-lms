@extends('layouts.app')

@section('page-title', $course->title)

@section('content')

{{-- Breadcrumb --}}
<div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
    <a href="{{ route('courses.index') }}" class="hover:text-blue-600">Courses</a>
    <span>›</span>
    <span class="text-gray-800">{{ $course->title }}</span>
</div>

{{-- Header --}}
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-5">
    <div class="flex items-start justify-between flex-wrap gap-4">
        <div class="flex items-start gap-5">
            {{-- Thumbnail --}}
            <div class="w-28 h-20 bg-gradient-to-br from-blue-400 to-blue-700 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-10 h-10 text-white opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                </svg>
            </div>
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <h1 class="text-xl font-bold text-gray-800">{{ $course->title }}</h1>
                    <span class="px-2.5 py-1 rounded-full text-xs font-medium
                        {{ $course->status === 'published' ? 'bg-green-100 text-green-700' :
                           ($course->status === 'draft' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600') }}">
                        {{ ucfirst($course->status) }}
                    </span>
                </div>
                <p class="text-sm text-gray-500 mb-3 max-w-xl">{{ Str::limit($course->description, 120) }}</p>
                <div class="flex items-center gap-5 text-xs text-gray-500 flex-wrap">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Course Code: <strong class="text-gray-700">{{ $course->code }}</strong>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        Category: <strong class="text-gray-700">{{ $course->category }}</strong>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Level: <strong class="text-gray-700">{{ $course->level }}</strong>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Created: <strong class="text-gray-700">{{ $course->created_at->format('M d, Y') }}</strong>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Last Updated: <strong class="text-blue-600">{{ $course->updated_at->format('M d, Y') }}</strong>
                    </span>
                </div>
            </div>
        </div>
        @if(auth()->user()->isEducator())
        <div class="flex gap-2 flex-shrink-0">
            <a href="{{ route('courses.edit', $course) }}"
               class="flex items-center gap-1.5 px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Course
            </a>
            <form action="{{ route('courses.destroy', $course) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this course?')">
                @csrf @method('DELETE')
                <button type="submit" class="flex items-center gap-1.5 px-4 py-2 bg-red-50 border border-red-200 rounded-lg text-sm text-red-600 hover:bg-red-100 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete Course
                </button>
            </form>
        </div>
        @endif
    </div>

    {{-- Tabs --}}
    <div class="flex gap-1 mt-5 border-b border-gray-200 -mb-6 pb-0">
        @foreach(['overview' => 'Overview', 'materials' => 'Materials', 'assignments' => 'Assignments', 'students' => 'Students', 'grades' => 'Grades', 'enrollments' => 'Enrollments'] as $tab => $label)
        <button onclick="switchTab('{{ $tab }}')"
                id="tab-btn-{{ $tab }}"
                class="tab-btn px-4 py-3 text-sm font-medium border-b-2 transition -mb-px
                {{ $tab === 'overview' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
            {{ $label }}
        </button>
        @endforeach
    </div>
</div>

{{-- Tab Contents --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

    {{-- LEFT COLUMN --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- OVERVIEW TAB --}}
        <div id="tab-overview" class="tab-content space-y-5">
            <div class="bg-white rounded-xl border border-gray-200 p-5">
                <h2 class="font-semibold text-gray-800 mb-3">Course Description</h2>
                <p class="text-sm text-gray-600 leading-relaxed mb-5">{{ $course->description ?? 'No description provided.' }}</p>

                <h3 class="text-sm font-semibold text-gray-700 mb-3">What You'll Learn</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mb-5">
                    @foreach(['Understand core concepts of the subject', 'Apply practical knowledge in projects', 'Differentiate key theories and use cases', 'Identify tools and real-world applications'] as $item)
                    <div class="flex items-start gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ $item }}
                    </div>
                    @endforeach
                </div>

                <h3 class="text-sm font-semibold text-gray-700 mb-3">Course Information</h3>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div class="flex justify-between py-2 border-b border-gray-50">
                        <span class="text-gray-500">Language</span>
                        <span class="font-medium text-gray-800">English</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-50">
                        <span class="text-gray-500">Duration</span>
                        <span class="font-medium text-gray-800">{{ $course->duration_weeks }} Weeks</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-50">
                        <span class="text-gray-500">Weekly Commitment</span>
                        <span class="font-medium text-gray-800">3–4 Hours</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-50">
                        <span class="text-gray-500">Total Students</span>
                        <span class="font-medium text-gray-800">{{ $course->learners->count() }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-500">Prerequisites</span>
                        <span class="font-medium text-gray-800">Basic computer knowledge</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- MATERIALS TAB --}}
        <div id="tab-materials" class="tab-content hidden space-y-5">
            <div class="bg-white rounded-xl border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-semibold text-gray-800">Course Materials</h2>
                    <a href="#" class="text-xs text-blue-600 hover:underline">View all</a>
                </div>
                @php
                    $materials = [
                        ['name' => 'Lecture 1: Introduction to ' . $course->title, 'type' => 'PDF', 'size' => '1.8 MB', 'date' => 'May 10, 2024', 'color' => 'red'],
                        ['name' => 'Lecture 2: Core Concepts', 'type' => 'Video', 'size' => '245 MB', 'date' => 'May 12, 2024', 'color' => 'blue'],
                        ['name' => 'Lecture 3: Practical Guide', 'type' => 'PDF', 'size' => '1.5 MB', 'date' => 'May 14, 2024', 'color' => 'red'],
                        ['name' => 'Lecture 4: Advanced Topics', 'type' => 'Video', 'size' => '28:30', 'date' => 'May 16, 2024', 'color' => 'blue'],
                        ['name' => 'Lecture 5: Case Studies', 'type' => 'PDF', 'size' => '2.3 MB', 'date' => 'May 18, 2024', 'color' => 'red'],
                        ['name' => 'Lecture 6: Hands-on Lab Guide', 'type' => 'PDF', 'size' => '3.0 MB', 'date' => 'May 20, 2024', 'color' => 'red'],
                    ];
                @endphp
                <div class="space-y-2">
                    @foreach($materials as $material)
                    <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg group">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0
                                {{ $material['color'] === 'red' ? 'bg-red-100' : 'bg-blue-100' }}">
                                @if($material['type'] === 'PDF')
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                @else
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                @endif
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-800">{{ $material['name'] }}</div>
                                <div class="text-xs text-gray-400">{{ $material['type'] }} · {{ $material['size'] }}</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-gray-400">{{ $material['date'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if(auth()->user()->isEducator())
                <button class="mt-4 w-full py-2.5 border-2 border-dashed border-gray-200 rounded-lg text-sm text-gray-400 hover:border-blue-300 hover:text-blue-500 transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Material
                </button>
                @endif
            </div>
        </div>

        {{-- ASSIGNMENTS TAB --}}
        <div id="tab-assignments" class="tab-content hidden">
            <div class="bg-white rounded-xl border border-gray-200 p-5">
                <h2 class="font-semibold text-gray-800 mb-4">Assignments</h2>
                <div class="text-center py-10 text-gray-400">
                    <svg class="w-10 h-10 mx-auto mb-2 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <p class="text-sm">No assignments yet.</p>
                </div>
            </div>
        </div>

        {{-- STUDENTS TAB --}}
        <div id="tab-students" class="tab-content hidden">
            <div class="bg-white rounded-xl border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-semibold text-gray-800">Enrolled Students</h2>
                    <span class="text-xs bg-blue-50 text-blue-700 px-2.5 py-1 rounded-full">{{ $course->learners->count() }} students</span>
                </div>
                @if($course->learners->isEmpty())
                <div class="text-center py-8 text-gray-400">
                    <p class="text-sm">No students enrolled yet.</p>
                </div>
                @else
                <div class="divide-y divide-gray-50">
                    @foreach($course->learners as $learner)
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-blue-100 rounded-full flex items-center justify-center text-xs font-medium text-blue-700">
                                {{ strtoupper(substr($learner->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-800">{{ $learner->name }}</div>
                                <div class="text-xs text-gray-400">{{ $learner->email }}</div>
                            </div>
                        </div>
                        <span class="text-xs text-green-600 bg-green-50 px-2.5 py-1 rounded-full">Active</span>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        {{-- GRADES TAB --}}
        <div id="tab-grades" class="tab-content hidden">
            <div class="bg-white rounded-xl border border-gray-200 p-5">
                <h2 class="font-semibold text-gray-800 mb-4">Grades</h2>
                <div class="text-center py-10 text-gray-400">
                    <svg class="w-10 h-10 mx-auto mb-2 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <p class="text-sm">No grades available yet.</p>
                </div>
            </div>
        </div>

        {{-- ENROLLMENTS TAB --}}
        <div id="tab-enrollments" class="tab-content hidden">
            <div class="bg-white rounded-xl border border-gray-200 p-5">
                <h2 class="font-semibold text-gray-800 mb-4">Enrollments</h2>
                @if($course->learners->isEmpty())
                <div class="text-center py-8 text-gray-400">
                    <p class="text-sm">No enrollments yet.</p>
                </div>
                @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-xs text-gray-400 border-b border-gray-100">
                            <th class="text-left pb-3 font-medium">Student</th>
                            <th class="text-left pb-3 font-medium">Enrolled On</th>
                            <th class="text-left pb-3 font-medium">Progress</th>
                            <th class="text-left pb-3 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($course->learners as $learner)
                        <tr>
                            <td class="py-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 bg-blue-100 rounded-full flex items-center justify-center text-xs font-medium text-blue-700">
                                        {{ strtoupper(substr($learner->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-800">{{ $learner->name }}</div>
                                        <div class="text-xs text-gray-400">{{ $learner->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 text-gray-500">{{ $learner->pivot->created_at->format('M d, Y') }}</td>
                            <td class="py-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-20 bg-gray-200 rounded-full h-1.5">
                                        <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $learner->pivot->progress }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-500">{{ $learner->pivot->progress }}%</span>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded-full">
                                    {{ ucfirst($learner->pivot->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>

    </div>

    {{-- RIGHT COLUMN --}}
    <div class="space-y-4">

        {{-- Enrolled Students Preview (Overview tab) --}}
        <div id="right-overview" class="right-tab-content">
            <div class="bg-white rounded-xl border border-gray-200 p-5">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="font-semibold text-gray-800">Enrolled Students</h2>
                    <a href="#" onclick="switchTab('students')" class="text-xs text-blue-600 hover:underline">View all</a>
                </div>
                @if($course->learners->isEmpty())
                <p class="text-sm text-gray-400 text-center py-4">No students enrolled yet.</p>
                @else
                <div class="space-y-2">
                    @foreach($course->learners->take(5) as $learner)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-xs font-medium text-blue-700">
                                {{ strtoupper(substr($learner->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-800">{{ $learner->name }}</div>
                                <div class="text-xs text-gray-400">{{ $learner->email }}</div>
                            </div>
                        </div>
                        <span class="text-xs text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Active</span>
                    </div>
                    @endforeach
                </div>
                @if($course->learners->count() > 5)
                <a href="#" onclick="switchTab('students')" class="text-xs text-blue-600 hover:underline mt-3 inline-block">
                    View all {{ $course->learners->count() }} students →
                </a>
                @endif
                @endif
            </div>

            {{-- Quick Stats --}}
            @if(auth()->user()->isEducator())
            <div class="bg-white rounded-xl border border-gray-200 p-5 mt-4">
                <h2 class="font-semibold text-gray-800 mb-4">Quick Stats</h2>
                <div class="grid grid-cols-2 gap-3">
                    <div class="text-center p-3 bg-blue-50 rounded-lg">
                        <div class="text-xl font-bold text-blue-700">{{ $course->learners->count() }}</div>
                        <div class="text-xs text-blue-500 mt-0.5">Students</div>
                    </div>
                    <div class="text-center p-3 bg-green-50 rounded-lg">
                        <div class="text-xl font-bold text-green-700">0</div>
                        <div class="text-xs text-green-500 mt-0.5">Assignments</div>
                    </div>
                    <div class="text-center p-3 bg-purple-50 rounded-lg">
                        <div class="text-xl font-bold text-purple-700">6</div>
                        <div class="text-xs text-purple-500 mt-0.5">Materials</div>
                    </div>
                    <div class="text-center p-3 bg-orange-50 rounded-lg">
                        <div class="text-xl font-bold text-orange-700">—</div>
                        <div class="text-xs text-orange-500 mt-0.5">Avg. Progress</div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Enroll Card (Learner) --}}
            @if(auth()->user()->isLearner())
            <div class="bg-white rounded-xl border border-gray-200 p-5 mt-4">
                @if($isEnrolled)
                <div class="text-center">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-800 mb-1">You're enrolled!</p>
                    <p class="text-xs text-gray-400 mb-3">You have full access to this course.</p>
                    <form action="{{ route('enroll.destroy', $course) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Leave this course?')"
                                class="w-full py-2 border border-red-200 text-red-600 rounded-lg text-sm hover:bg-red-50 transition">
                            Leave Course
                        </button>
                    </form>
                </div>
                @else
                <p class="text-sm text-gray-500 mb-3">Enroll now to access all course materials and assignments.</p>
                <form action="{{ route('enroll.store', $course) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                        Enroll Now
                    </button>
                </form>
                @endif
            </div>
            @endif
        </div>

    </div>
</div>

<script>
function switchTab(tab) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('border-blue-600', 'text-blue-600');
        btn.classList.add('border-transparent', 'text-gray-500');
    });
    document.getElementById('tab-' + tab).classList.remove('hidden');
    const btn = document.getElementById('tab-btn-' + tab);
    btn.classList.remove('border-transparent', 'text-gray-500');
    btn.classList.add('border-blue-600', 'text-blue-600');
}
</script>

@endsection