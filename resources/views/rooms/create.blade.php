<x-app-layout>
    <x-slot name="header">
        <div class="bg-[#48426d] px-4 py-6 rounded-md shadow">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Rooms') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded px-8 py-6">
            <form action="{{ route('rooms.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="room_number">
                        Room Number
                    </label>
                    <input type="text" name="room_number" id="room_number"
                           class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-blue-500"
                           value="{{ old('room_number') }}" required>
                    @error('room_number')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="capacity">
                        Capacity
                    </label>
                    <input type="number" name="capacity" id="capacity"
                           class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-blue-500"
                           value="{{ old('capacity') }}" required>
                    @error('capacity')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="price">
                        Price
                    </label>
                    <input type="number" name="price" id="price" step="0.01"
                           class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-blue-500"
                           value="{{ old('price') }}" required>
                    @error('price')
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
                        Save Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
