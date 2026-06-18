<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Edu Seria LMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

<div class="min-h-screen flex">

    {{-- Left Panel --}}
    <div class="hidden lg:flex w-1/2 bg-[#0f1f4b] flex-col justify-center px-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-32 h-32 border-2 border-blue-400 rounded-full"></div>
            <div class="absolute bottom-32 right-10 w-48 h-48 border-2 border-blue-400 rounded-full"></div>
            <div class="absolute top-1/2 left-1/2 w-64 h-64 border border-blue-400 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-16">
                <div class="bg-blue-500 rounded-lg p-2.5">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.357l4-2a1 1 0 11.788 1.838L7.667 8.75l1.227.525a1 1 0 00.788 0l7-3a1 1 0 000-1.84l-7-3z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-white font-bold text-lg">Edu Seria</div>
                    <div class="text-blue-300 text-xs">Learning Management System</div>
                </div>
            </div>
            <h1 class="text-5xl font-bold text-white leading-tight mb-4">
                Join Us<br>
                <span class="text-blue-400">Today.</span>
            </h1>
            <p class="text-blue-200 text-lg leading-relaxed">
                Create your account and start your learning journey with Edu Seria LMS.
            </p>
        </div>
    </div>

    {{-- Right Panel --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center px-8 py-12 bg-white">
        <div class="w-full max-w-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-1">Create Account</h2>
            <p class="text-gray-500 text-sm mb-8">Sign up for your Edu Seria LMS account</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror"
                           placeholder="Enter your full name">
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-400 @enderror"
                           placeholder="Enter your email">
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Register as</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="learner"
                                   class="peer sr-only" {{ old('role', 'learner') == 'learner' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 rounded-lg p-3 text-center transition">
                                <div class="text-2xl mb-1">🎓</div>
                                <div class="text-sm font-medium text-gray-700">Learner</div>
                                <div class="text-xs text-gray-400">I want to learn</div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="educator"
                                   class="peer sr-only" {{ old('role') == 'educator' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 rounded-lg p-3 text-center transition">
                                <div class="text-2xl mb-1">👨‍🏫</div>
                                <div class="text-sm font-medium text-gray-700">Educator</div>
                                <div class="text-xs text-gray-400">I want to teach</div>
                            </div>
                        </label>
                    </div>
                    @error('role')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-400 @enderror"
                           placeholder="Minimum 8 characters">
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Re-enter your password">
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg text-sm transition">
                    Create Account
                </button>

                <p class="text-center text-sm text-gray-500 mt-5">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Sign in here</a>
                </p>
            </form>
        </div>
    </div>
</div>

</body>
</html>