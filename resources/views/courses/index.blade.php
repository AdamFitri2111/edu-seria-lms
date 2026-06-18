@extends('layouts.app')

@section('page-title', 'Course Management')

@section('content')

<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            {{ auth()->user()->isEducator() ? 'Course Management' : 'Browse Courses' }}
        </h1>
        <p class="text-gray-500 text-sm mt-1">
            {{ auth()->user()->isEducator() ? 'Create, view, update, and manage all your courses.' : 'Explore and enroll in available courses.' }}
        </p>
    </div>
    @if(auth()->user()->isEducator())
    <a href="{{ route('courses.create') }}"
       class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-lg transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Create New Course
    </a>
    @endif
</div>

{{-- Search & Filter --}}
<div class="bg-white rounded-xl border border-gray-200 p-4 mb-4">
    <div class="flex flex-wrap gap-3 items-center">
        <div class="relative flex-1 min-w-48">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                </svg>
            </span>
            <input type="text" id="searchInput" placeholder="Search courses..."
                   class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <select id="statusFilter" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">All Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
            <option value="archived">Archived</option>
        </select>
        <select id="categoryFilter" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">All Categories</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Data Science">Data Science</option>
            <option value="Business">Business</option>
            <option value="Design">Design</option>
            <option value="General">General</option>
        </select>
        <button onclick="resetFilters()" class="flex items-center gap-1.5 px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-gray-50">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Reset
        </button>
    </div>
</div>

{{-- Table --}}
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    @if($courses->isEmpty())
    <div class="text-center py-16 text-gray-400">
        <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
        </svg>
        <p class="text-sm font-medium">No courses found.</p>
        @if(auth()->user()->isEducator())
        <a href="{{ route('courses.create') }}" class="text-blue-600 text-sm hover:underline mt-1 inline-block">Create your first course →</a>
        @endif
    </div>
    @else
    <table class="w-full text-sm" id="coursesTable">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Course</th>
                <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Category</th>
                <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Students</th>
                <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Status</th>
                <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Last Updated</th>
                <th class="text-left px-5 py-3 text-xs font-medium text-gray-500">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100" id="tableBody">
            @foreach($courses as $course)
            <tr class="hover:bg-gray-50 course-row"
                data-title="{{ strtolower($course->title) }}"
                data-status="{{ $course->status }}"
                data-category="{{ $course->category }}">
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-800">{{ $course->title }}</div>
                            <div class="text-xs text-gray-400">{{ $course->code }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-5 py-4">
                    <span class="px-2.5 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-medium">
                        {{ $course->category }}
                    </span>
                </td>
                <td class="px-5 py-4 text-gray-600">{{ $course->enrollments_count }}</td>
                <td class="px-5 py-4">
                    <span class="px-2.5 py-1 rounded-full text-xs font-medium
                        {{ $course->status === 'published' ? 'bg-green-100 text-green-700' :
                           ($course->status === 'draft' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600') }}">
                        {{ ucfirst($course->status) }}
                    </span>
                </td>
                <td class="px-5 py-4 text-gray-500 text-xs">{{ $course->updated_at->format('M d, Y') }}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('courses.show', $course) }}"
                           class="p-1.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded" title="View">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </a>
                        @if(auth()->user()->isEducator())
                        <a href="{{ route('courses.edit', $course) }}"
                           class="p-1.5 text-gray-400 hover:text-yellow-600 hover:bg-yellow-50 rounded" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this course?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-5 py-3 border-t border-gray-100 text-xs text-gray-400">
        Showing {{ $courses->count() }} of {{ $courses->total() }} courses
    </div>
    <div class="px-5 pb-4">
        {{ $courses->links() }}
    </div>
    @endif
</div>

<script>
function filterTable() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const status = document.getElementById('statusFilter').value.toLowerCase();
    const category = document.getElementById('categoryFilter').value.toLowerCase();
    document.querySelectorAll('.course-row').forEach(row => {
        const matchTitle = row.dataset.title.includes(search);
        const matchStatus = status === '' || row.dataset.status === status;
        const matchCategory = category === '' || row.dataset.category.toLowerCase() === category;
        row.style.display = matchTitle && matchStatus && matchCategory ? '' : 'none';
    });
}
function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('categoryFilter').value = '';
    filterTable();
}
document.getElementById('searchInput').addEventListener('input', filterTable);
document.getElementById('statusFilter').addEventListener('change', filterTable);
document.getElementById('categoryFilter').addEventListener('change', filterTable);
</script>

@endsection