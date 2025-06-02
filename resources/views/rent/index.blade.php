<x-app-layout>
    <x-slot name="header">
        <div class="bg-[#48426d] px-6 py-6 rounded-md shadow">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Rental Transaction') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
        {{-- Rental creation form --}}
        <div class="mb-8 bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-6 text-gray-800 dark:text-gray-100">Create New Rental</h3>

            <form action="{{ route('rentals.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Student select with Tom Select --}}
                <div>
                    <label for="student_id" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Student</label>
                    <select id="student_id" name="student_id" required
                        class="tom-select mt-1 block w-full rounded-md border border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 py-2 px-3 text-base leading-6 shadow-sm focus:ring-[#48426d] focus:border-[#48426d]">
                        <option value="" disabled selected>Choose a student</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Room select with Tom Select --}}
                <div>
                    <label for="room_id" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Room Number</label>
                    <select id="room_id" name="room_id" required
                        class="tom-select mt-1 block w-full rounded-md border border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 py-2 px-3 text-base leading-6 shadow-sm focus:ring-[#48426d] focus:border-[#48426d]">
                        <option value="" disabled selected>Choose a room</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                {{ $room->room_number }}
                            </option>
                        @endforeach
                    </select>
                    @error('room_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Start date --}}
                <div>
                    <label for="start_date" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Start Date</label>
                    <input type="date" id="start_date" name="start_date" required
                        value="{{ old('start_date') }}"
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 py-2 px-3 text-base leading-6 shadow-sm focus:ring-[#48426d] focus:border-[#48426d]" />
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- End date --}}
                <div>
                    <label for="end_date" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">End Date</label>
                    <input type="date" id="end_date" name="end_date" required
                        value="{{ old('end_date') }}"
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 py-2 px-3 text-base leading-6 shadow-sm focus:ring-[#48426d] focus:border-[#48426d]" />
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit button --}}
                <div>
                    <button type="submit"
                        class="inline-flex justify-center rounded-md border border-transparent bg-[#48426d] py-2 px-6 text-base font-semibold text-white shadow-sm hover:bg-[#3a3757] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#48426d]">
                        Add Rental
                    </button>
                </div>
            </form>
        </div>

        {{-- Rentals list --}}
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">All Rentals</h3>

            <table class="min-w-full table-auto border-collapse border border-gray-200 dark:border-gray-600">
                <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-sm uppercase tracking-wide">
                    <tr>
                        <th class="border-b border-gray-200 dark:border-gray-600 px-6 py-3 text-left">Student</th>
                        <th class="border-b border-gray-200 dark:border-gray-600 px-6 py-3 text-left">Room</th>
                        <th class="border-b border-gray-200 dark:border-gray-600 px-6 py-3 text-left">Start Date</th>
                        <th class="border-b border-gray-200 dark:border-gray-600 px-6 py-3 text-left">End Date</th>
                        <th class="border-b border-gray-200 dark:border-gray-600 px-6 py-3 text-left">Status</th>
                        <th class="border-b border-gray-200 dark:border-gray-600 px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 dark:text-gray-300 text-sm">
                    @forelse ($rentals as $rental)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-900 transition">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $rental->student->name ?? 'Unknown' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Room {{ $rental->room->room_number ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $rental->start_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $rental->end_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $rental->status }}</td>
                            <td class="px-6 py-4 whitespace-nowrap space-x-3">
                                <a href="{{ route('rentals.edit', $rental->id) }}" class="text-[#48426d] hover:text-[#3a3757] font-medium text-sm">Edit</a>
                                <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this rental?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-700 dark:text-gray-300">No rentals found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">
                {{ $rentals->links() }}
            </div>
        </div>

        <div class="mt-6 text-right">
            <a href="{{ route('rentals.pdf') }}" target="_blank"
                class="inline-flex items-center px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                <!-- Heroicon: Printer -->
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M6 9v6m6-6v6m-3 3h6a2 2 0 002-2v-5a2 2 0 00-2-2h-6a2 2 0 00-2 2v5a2 2 0 002 2zM6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h2"/>
                </svg>
                Print to PDF
            </a>
        </div>
    </div>
</x-app-layout>
