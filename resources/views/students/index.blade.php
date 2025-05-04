<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <div class="p-6 text-gray-900 w-full">

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('students.index') }}" class="mb-4 flex space-x-2">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search students..."
                            value="{{ request('search') }}"
                            class="px-4 py-2 border border-gray-300 rounded w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        />
                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition"
                        >
                            Search
                        </button>
                    </form>

                    <!-- Student Table -->
                    <table class="w-full text-sm text-left text-gray-700">
                        <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                            <tr>
                                <th class="px-6 py-3">#</th>
                                <th class="px-6 py-3">Name</th>
                                <th class="px-6 py-3">Address</th>
                                <th class="px-6 py-3">Phone</th>
                                <th class="px-6 py-3">Gender</th>
                                <th class="px-6 py-3">DOB</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($students as $student)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                                    <td class="px-6 py-4 font-medium">{{ $student->name }}</td>
                                    <td class="px-6 py-4">{{ $student->address }}</td>
                                    <td class="px-6 py-4">{{ $student->phone_number }}</td>
                                    <td class="px-6 py-4">{{ $student->gender }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($student->dob)->format('F j, Y') }}
                                    </td>
                                    <td class="px-6 py-4 space-x-2">
                                        <!-- Edit Icon -->
                                        <a href="{{ route('students.edit', $student->id) }}"
                                           class="inline-block px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600 transition">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Delete Icon -->
                                        <form action="{{ route('students.destroy', $student->id) }}"
                                              method="POST"
                                              class="inline-block"
                                              onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600 transition">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No students found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $students->links() }}
                    </div>

                    <!-- Add Button -->
                    <div class="mt-6 flex justify-center">
                    <a href="{{ route('students.create') }}"
                    class="px-4 py-2 bg-green-500 text-white text-sm rounded hover:bg-green-600 transition">
                        + Add Student
                    </a>

                    <a href="{{ route('students.export') }}"
                    class="ml-4 px-4 py-2 bg-red-500 text-white text-sm rounded hover:bg-red-600 transition">
                        Export PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
