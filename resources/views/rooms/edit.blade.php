<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Room') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded px-8 py-6">
            <form action="{{ route('rooms.update', $room) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="room_number" class="block text-gray-700 font-bold mb-2">Room Number</label>
                    <input type="text" name="room_number" id="room_number" required
                           class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-blue-500"
                           value="{{ old('room_number', $room->room_number) }}">
                    @error('room_number')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="capacity" class="block text-gray-700 font-bold mb-2">Capacity</label>
                    <input type="number" name="capacity" id="capacity" required min="1"
                           class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-blue-500"
                           value="{{ old('capacity', $room->capacity) }}">
                    @error('capacity')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
                    <input type="number" name="price" id="price" step="0.01" required min="0"
                           class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-blue-500"
                           value="{{ old('price', $room->price) }}">
                    @error('price')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="is_available" class="block text-gray-700 font-bold mb-2">Status</label>
                    <select name="is_available" id="is_available"
                            class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-blue-500">
                        <option value="1" {{ old('is_available', $room->is_available) == 1 ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ old('is_available', $room->is_available) == 0 ? 'selected' : '' }}>Unavailable</option>
                    </select>
                    @error('is_available')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div class="flex justify-end">
                    <a href="{{ route('rooms.index') }}"
                       class="mr-3 px-4 py-2 text-gray-600 border border-gray-300 rounded hover:bg-gray-100">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Update Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
