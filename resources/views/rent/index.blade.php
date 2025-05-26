<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Rental Transactions') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto mt-6 px-4 bg-white shadow rounded-lg p-6">
        {{-- Rental creation form --}}
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-6">Create New Rental</h3>

            <form action="{{ route('rentals.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Student select with Tom Select --}}
                <div>
                    <label for="student_id" class="block mb-2 text-sm font-medium text-gray-700">Student</label>
                    <select id="student_id" name="student_id" required
                        class="tom-select mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base leading-6 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
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
                    <label for="room_id" class="block mb-2 text-sm font-medium text-gray-700">Room Number</label>
                    <select id="room_id" name="room_id" required
                        class="tom-select mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base leading-6 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
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
                    <label for="start_date" class="block mb-2 text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" id="start_date" name="start_date" required
                        value="{{ old('start_date') }}"
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base leading-6 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" />
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- End date --}}
                <div>
                    <label for="end_date" class="block mb-2 text-sm font-medium text-gray-700">End Date</label>
                    <input type="date" id="end_date" name="end_date" required
                        value="{{ old('end_date') }}"
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base leading-6 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" />
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit button --}}
                <div>
                    <button type="submit"
                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-6 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Add Rental
                    </button>
                </div>
            </form>
        </div>

        {{-- Rentals list --}}
        <div>
            <h3 class="text-xl font-semibold mb-4">All Rentals</h3>

            <table class="w-full table-auto border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2 text-left">Student</th>
                        <th class="border px-4 py-2 text-left">Room</th>
                        <th class="border px-4 py-2 text-left">Start Date</th>
                        <th class="border px-4 py-2 text-left">End Date</th>
                        <th class="border px-4 py-2 text-left">Status</th>
                        <th class="border px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rentals as $rental)
                        <tr class="border-t">
                            <td class="border px-4 py-2">{{ $rental->student->name ?? 'Unknown' }}</td>
                            <td class="border px-4 py-2">Room {{ $rental->room->room_number ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $rental->start_date }}</td>
                            <td class="border px-4 py-2">{{ $rental->end_date }}</td>
                            <td class="border px-4 py-2 capitalize">{{ $rental->status }}</td>
                            <td class="border px-4 py-2 space-x-2">
                                <a href="{{ route('rentals.edit', $rental->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this rental?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No rentals found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $rentals->links() }}
            </div>
        </div>
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('rentals.pdf') }}" target="_blank"
            class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-white text-sm font-medium shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Print to PDF
            </a>
        </div>

    </div>

    {{-- Tom Select Assets --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    {{-- Tom Select Initialization --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const baseConfig = {
            maxItems: 1,
            placeholder: "Select an option...",
            render: {
                option: function(data, escape) {
                    return `<div class="px-3 py-2 hover:bg-indigo-100 text-sm text-gray-800">${escape(data.text)}</div>`;
                },
                item: function(data, escape) {
                    return `<div class="text-sm text-gray-900">${escape(data.text)}</div>`;
                }
            },
            onInitialize: function () {
                const wrapper = this.wrapper;
                wrapper.classList.add(
                    'border',
                    'border-gray-300',
                    'rounded-md',
                    'shadow-sm',
                    'bg-white',
                    'focus-within:ring-1',
                    'focus-within:ring-indigo-500',
                    'focus-within:border-indigo-500',
                    'px-3',
                    'py-2',
                    'text-base',
                    'leading-6',
                    'text-gray-900'
                );
            }
        };
            new TomSelect("#student_id", {
                maxItems: 1,
                placeholder: "Choose a student...",
                render: {
                    option: function(data, escape) {
                        return `<div class="px-3 py-2 hover:bg-indigo-100 text-sm text-gray-800">${escape(data.text)}</div>`;
                    },
                    item: function(data, escape) {
                        return `<div class="text-sm text-gray-900">${escape(data.text)}</div>`;
                    }
                },
            });

            new TomSelect("#room_id", {
                maxItems: 1,
                placeholder: "Choose a room...",
                render: {
                    option: function(data, escape) {
                        return `<div class="px-3 py-2 hover:bg-indigo-100 text-sm text-gray-800">${escape(data.text)}</div>`;
                    },
                    item: function(data, escape) {
                        return `<div class="text-sm text-gray-900">${escape(data.text)}</div>`;
                    }
                },
            });
        });
    </script>

    <style>
        /* Fix Tom Select dropdown background */
        .ts-dropdown,
        .ts-dropdown-content,
        .ts-option {
            background-color: white !important;
            color: #1f2937; /* Tailwind's gray-800 text color */
        }

        /* Optional: Hover and selected item styles */
        .ts-option.ts-focus {
            background-color: #e0e7ff !important; /* Tailwind indigo-100 */
            color: #3730a3 !important; /* Tailwind indigo-800 */
        }

        .ts-option.ts-selected {
            background-color: #4338ca !important; /* Tailwind indigo-700 */
            color: white !important;
        }
    </style>


</x-app-layout>
