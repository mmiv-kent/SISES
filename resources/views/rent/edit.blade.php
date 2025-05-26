<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Rental') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 px-4 bg-white shadow rounded-lg p-6">
        <form action="{{ route('rentals.update', $rental->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Student select with Tom Select --}}
            <div>
                <label for="student_id" class="block mb-2 text-sm font-medium text-gray-700">Student</label>
                <select id="student_id" name="student_id" required
                    class="tom-select mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base leading-6 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    <option value="" disabled>Choose a student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}" {{ $rental->student_id == $student->id ? 'selected' : '' }}>
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
                    <option value="" disabled>Choose a room</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ $rental->room_id == $room->id ? 'selected' : '' }}>
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
                    value="{{ old('start_date', $rental->start_date) }}"
                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base leading-6 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" />
                @error('start_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- End date --}}
            <div>
                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-700">End Date</label>
                <input type="date" id="end_date" name="end_date" required
                    value="{{ old('end_date', $rental->end_date) }}"
                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base leading-6 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" />
                @error('end_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" required
                    class="tom-select mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 text-base leading-6 text-gray-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    <option value="active" {{ $rental->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ $rental->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="canceled" {{ $rental->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit button --}}
            <div>
                <button type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-6 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Update Rental
                </button>
            </div>
        </form>
    </div>

    {{-- Tom Select Assets --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new TomSelect("#student_id", {
                maxItems: 1,
                placeholder: "Choose a student...",
                dropdownClass: 'bg-white border border-gray-200 shadow-md rounded-md mt-1'
            });
            new TomSelect("#room_id", {
                maxItems: 1,
                placeholder: "Choose a room...",
                dropdownClass: 'bg-white border border-gray-200 shadow-md rounded-md mt-1'
            });
            new TomSelect("#status", {
                maxItems: 1,
                placeholder: "Select status...",
                dropdownClass: 'bg-white border border-gray-200 shadow-md rounded-md mt-1'
            });
        });
    </script>
</x-app-layout>
