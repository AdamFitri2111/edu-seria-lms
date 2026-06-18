@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')

@if(auth()->user()->isEducator())
{{-- ===== EDUCATOR DASHBOARD ===== --}}
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Welcome back, {{ auth()->user()->name }}! 👋</h1>
        <p class="text-gray-500 text-sm mt-1">Here's what's happening in your classes today.</p>
    </div>
    <a href="{{ route('courses.create') }}"
       class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Create New Course
    </a>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-gray-500 font-medium">My Courses</span>
            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-800">{{ $data['totalCourses'] }}</div>
        <div class="text-xs text-gray-400 mt-1">Total Courses</div>
        <a href="{{ route('courses.index') }}" class="text-xs text-blue-600 hover:underline mt-2 inline-block">View all courses →</a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-gray-500 font-medium">Students</span>
            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-800">{{ $data['totalStudents'] }}</div>
        <div class="text-xs text-gray-400 mt-1">Total Enrolled</div>
        <a href="{{ route('users.index') }}" class="text-xs text-blue-600 hover:underline mt-2 inline-block">View all students →</a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-gray-500 font-medium">Assignments</span>
            <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-800">0</div>
        <div class="text-xs text-gray-400 mt-1">Due this week</div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-gray-500 font-medium">Average Progress</span>
            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-800">—</div>
        <div class="text-xs text-gray-400 mt-1">Across all courses</div>
    </div>
</div>

{{-- Course Overview Table --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-gray-800">Course Overview</h2>
            <span class="text-xs text-gray-400">This Semester</span>
        </div>

        @if($data['recentCourses']->isEmpty())
        <div class="text-center py-8 text-gray-400">
            <svg class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
            </svg>
            <p class="text-sm">No more courses.</p>
            <a href="{{ route('courses.create') }}" class="text-blue-600 text-sm hover:underline">Create the first course →</a>
        </div>
        @else
        <table class="w-full text-sm">
            <thead>
                <tr class="text-xs text-gray-400 border-b border-gray-100">
                    <th class="text-left pb-3 font-medium">Course Title</th>
                    <th class="text-left pb-3 font-medium">Students</th>
                    <th class="text-left pb-3 font-medium">Status</th>
                    <th class="pb-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($data['recentCourses'] as $course)
                <tr class="hover:bg-gray-50">
                    <td class="py-3">
                        <div class="font-medium text-gray-800">{{ $course->title }}</div>
                        <div class="text-xs text-gray-400">{{ $course->code }}</div>
                    </td>
                    <td class="py-3 text-gray-600">{{ $course->enrollments_count }}</td>
                    <td class="py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            {{ $course->status === 'published' ? 'bg-green-100 text-green-700' : ($course->status === 'draft' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600') }}">
                            {{ ucfirst($course->status) }}
                        </span>
                    </td>
                    <td class="py-3">
                        <a href="{{ route('courses.show', $course) }}" class="text-blue-600 hover:text-blue-800">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('courses.index') }}" class="text-xs text-blue-600 hover:underline mt-3 inline-block">View all courses →</a>
        @endif
    </div>

    {{-- Upcoming Activities --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-gray-800">Upcoming Activities</h2>
        </div>
        <div class="space-y-3">
            <div class="flex gap-3 p-3 bg-gray-50 rounded-lg">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                    <div class="text-center"><div class="text-xs">JUN</div><div class="text-sm font-bold">22</div></div>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-800">Cloud Computing Assignment</div>
                    <div class="text-xs text-gray-400">Due Jun 22, 2026</div>
                    <span class="text-xs text-orange-500 font-medium">Due Soon</span>
                </div>
            </div>
            <div class="flex gap-3 p-3 bg-gray-50 rounded-lg">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                    <div class="text-center"><div class="text-xs">JUN</div><div class="text-sm font-bold">27</div></div>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-800">Web Development Project</div>
                    <div class="text-xs text-gray-400">Due Jun 27, 2026</div>
                </div>
            </div>
        </div>
    </div>
</div>

@else
{{-- ===== LEARNER DASHBOARD ===== --}}
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Welcome back, {{ auth()->user()->name }}! 👋</h1>
    <p class="text-gray-500 text-sm mt-1">Here's what's happening in your classes today!</p>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-gray-500 font-medium">Enrolled Courses</span>
            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-800">{{ $data['totalEnrolled'] }}</div>
        <div class="text-xs text-gray-400 mt-1">Active Courses</div>
        <a href="{{ route('my.courses') }}" class="text-xs text-blue-600 hover:underline mt-2 inline-block">View my courses →</a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-gray-500 font-medium">Assignments Due</span>
            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-800">0</div>
        <div class="text-xs text-gray-400 mt-1">Pending</div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-gray-500 font-medium">Average Grade</span>
            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-800">—</div>
        <div class="text-xs text-gray-400 mt-1">Across all courses</div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs text-gray-500 font-medium">Learning Progress</span>
            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
        </div>
        <div class="text-2xl font-bold text-gray-800">—</div>
        <div class="text-xs text-gray-400 mt-1">Keep going!</div>
    </div>
</div>

{{-- My Courses + Upcoming --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-gray-800">My Courses</h2>
            <a href="{{ route('my.courses') }}" class="text-xs text-blue-600 hover:underline">View all courses →</a>
        </div>

        @if($data['enrolledCourses']->isEmpty())
        <div class="text-center py-8 text-gray-400">
            <svg class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
            </svg>
            <p class="text-sm">Belum daftar mana-mana kursus.</p>
            <a href="{{ route('courses.index') }}" class="text-blue-600 text-sm hover:underline">Semak imbas kursus →</a>
        </div>
        @else
        <div class="space-y-3">
            @foreach($data['enrolledCourses'] as $course)
            <div class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-50">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-medium text-gray-800 truncate">{{ $course->title }}</div>
                    <div class="text-xs text-gray-400">{{ $course->educator->name }}</div>
                    <div class="mt-1.5 flex items-center gap-2">
                        <div class="flex-1 bg-gray-200 rounded-full h-1.5">
                            <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $course->pivot->progress }}%"></div>
                        </div>
                        <span class="text-xs text-gray-500">{{ $course->pivot->progress }}%</span>
                    </div>
                </div>
                <a href="{{ route('courses.show', $course) }}" class="text-gray-400 hover:text-blue-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- Upcoming Assignments --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-gray-800">Upcoming Assignments</h2>
        </div>
        <div class="space-y-3">
            <div class="flex gap-3 p-3 bg-gray-50 rounded-lg">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white flex-shrink-0">
                    <div class="text-center leading-tight"><div class="text-xs">JUN</div><div class="text-sm font-bold">22</div></div>
                </div>
                <div>
                    <div class="text-sm font-medium text-gray-800">Cloud Computing Assignment</div>
                    <div class="text-xs text-gray-400">Due Jun 22, 2026</div>
                    <span class="text-xs text-orange-500 font-medium">Due Soon</span>
                </div>
            </div>
            <div class="text-center py-4 text-xs text-gray-400">Tiada assignment lain.</div>
        </div>
    </div>
</div>
@endif

@endsection