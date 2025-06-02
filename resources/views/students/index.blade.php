<x-app-layout>
    <x-slot name="header">
        <div class="bg-[#48426d] px-6 py-6 rounded-md shadow">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Students') }}
            </h2>
        </div>
    </x-slot>

    <!-- Search / Filter Form -->
    <form method="GET" action="{{ route('students.index') }}" class="mb-8 space-y-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap gap-6 items-end">

            <div class="flex-1 min-w-[180px]">
                <label for="search" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Name / Address / Phone</label>
                <input
                    type="text"
                    name="search"
                    id="search"
                    value="{{ request('search') }}"
                    placeholder="Search students..."
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-[#48426d] focus:border-[#48426d] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                />
            </div>

            <div class="flex-1 min-w-[140px]">
                <label for="gender" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Gender</label>
                <select
                    name="gender"
                    id="gender"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-[#48426d] focus:border-[#48426d] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                >
                    <option value="">-- Any --</option>
                    <option value="male" {{ request('gender') === 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ request('gender') === 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div class="flex-1 min-w-[180px]">
                <label for="dob" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Date of Birth</label>
                <input
                    type="date"
                    name="dob"
                    id="dob"
                    value="{{ request('dob') }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-[#48426d] focus:border-[#48426d] dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                />
            </div>

            <div class="flex-shrink-0 space-x-2">
                <button
                    type="submit"
                    class="inline-flex items-center justify-center py-2 px-5 border border-transparent shadow-sm text-sm font-semibold rounded-md text-white bg-[#48426d] hover:bg-[#3a3757] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#48426d]"
                >
                    <!-- Heroicon: Filter -->
                    <svg
                        class="w-5 h-5 mr-2 -ml-1"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L14 13.414V19a1 1 0 01-1.447.894l-4-2A1 1 0 018 17v-3.586L3.293 6.707A1 1 0 013 6V4z"
                        />
                    </svg>
                    Filter
                </button>

                <a
                    href="{{ route('students.index') }}"
                    class="inline-flex items-center justify-center py-2 px-5 border border-gray-300 shadow-sm text-sm font-semibold rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#48426d]"
                >
                    Clear
                </a>
            </div>
        </div>
    </form>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Student List</h1>
            <a
                href="{{ route('students.create') }}"
                class="inline-flex items-center px-5 py-2 bg-[#48426d] text-white rounded-md hover:bg-[#3a3757] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#48426d]"
            >
                <!-- Heroicon: Plus -->
                <svg
                    class="w-5 h-5 mr-2"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    viewBox="0 0 24 24"
                >
                    <path d="M12 4v16m8-8H4" />
                </svg>
                Add New Student
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-sm uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-3 text-left border-b border-gray-200 dark:border-gray-600">#</th>
                        <th class="px-6 py-3 text-left border-b border-gray-200 dark:border-gray-600">Name</th>
                        <th class="px-6 py-3 text-left border-b border-gray-200 dark:border-gray-600">Address</th>
                        <th class="px-6 py-3 text-left border-b border-gray-200 dark:border-gray-600">Phone</th>
                        <th class="px-6 py-3 text-left border-b border-gray-200 dark:border-gray-600">Gender</th>
                        <th class="px-6 py-3 text-left border-b border-gray-200 dark:border-gray-600">DOB</th>
                        <th class="px-6 py-3 text-left border-b border-gray-200 dark:border-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 dark:text-gray-300 text-sm">
                    @forelse ($students as $student)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}
                            </td>
                            <td class="px-6 py-4 font-medium">{{ $student->name }}</td>
                            <td class="px-6 py-4">{{ $student->address }}</td>
                            <td class="px-6 py-4">{{ $student->phone_number }}</td>
                            <td class="px-6 py-4">{{ ucfirst($student->gender) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($student->dob)->format('F j, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap space-x-3">
                                <a href="{{ route('students.edit', $student) }}" class="text-[#48426d] hover:text-[#3a3757] font-medium text-sm">Edit</a>

                                <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm font-medium">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">
                {{ $students->links() }}
            </div>
        </div>

        <div class="mt-6 text-right">
            <a
                href="{{ route('students.export', request()->query()) }}"
                target="_blank"
                class="inline-flex items-center px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600"
            >
                <!-- Heroicon: Printer -->
                <svg
                    class="w-5 h-5 mr-2"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    viewBox="0 0 24 24"
                >
                    <path d="M6 9v6m6-6v6m-3 3h6a2 2 0 002-2v-5a2 2 0 00-2-2h-6a2 2 0 00-2 2v5a2 2 0 002 2zM6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h2" />
                </svg>
                Export PDF
            </a>
        </div>
    </div>
</x-app-layout>
