@extends('layouts.app')

@section('page-title', 'My Courses')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">My Courses</h1>
    <p class="text-gray-500 text-sm mt-1">Courses you have enrolled in.</p>
</div>

@if($courses->isEmpty())
<div class="bg-white rounded-xl border border-gray-200 p-16 text-center">
    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
        </svg>
    </div>
    <h3 class="text-gray-700 font-medium mb-1">No courses yet</h3>
    <p class="text-gray-400 text-sm mb-4">You have not enrolled in any course yet.</p>
    <a href="{{ route('courses.index') }}"
       class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">
        Browse Courses
    </a>
</div>
@else
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach($courses as $course)
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:border-blue-300 transition">
        <div class="h-32 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
            <svg class="w-12 h-12 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
            </svg>
        </div>
        <div class="p-4">
            <div class="flex items-start justify-between mb-2">
                <h3 class="font-semibold text-gray-800 text-sm leading-snug">{{ $course->title }}</h3>
                <span class="px-2 py-0.5 bg-blue-50 text-blue-700 rounded text-xs ml-2 flex-shrink-0">{{ $course->code }}</span>
            </div>
            <p class="text-xs text-gray-400 mb-1">{{ $course->educator->name }}</p>
            <div class="flex items-center gap-2 mb-3">
                <span class="text-xs text-gray-500">{{ $course->category }}</span>
                <span class="text-gray-300">·</span>
                <span class="text-xs text-gray-500">{{ $course->level }}</span>
            </div>

            {{-- Progress Bar --}}
            <div class="mb-3">
                <div class="flex justify-between text-xs text-gray-500 mb-1">
                    <span>Progress</span>
                    <span>{{ $course->pivot->progress }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    <div class="bg-blue-600 h-1.5 rounded-full transition-all"
                         style="width: {{ $course->pivot->progress }}%"></div>
                </div>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('courses.show', $course) }}"
                   class="flex-1 text-center py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition">
                    Continue Learning
                </a>
                <form action="{{ route('enroll.destroy', $course) }}" method="POST"
                      onsubmit="return confirm('Leave this course?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="px-3 py-2 border border-gray-200 text-gray-400 hover:text-red-500 hover:border-red-200 text-xs rounded-lg transition">
                        Leave
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection