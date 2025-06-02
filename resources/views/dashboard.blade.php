<x-app-layout>
    <x-slot name="header">
        <div class="bg-[#48426d] px-4 py-6 rounded-md shadow">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600 dark:text-gray-400">Here’s a quick overview of your system.</p>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-[#48426d] text-white rounded-lg p-6 shadow">
                    <h4 class="text-lg font-semibold">Total Students</h4>
                    <p class="text-3xl font-bold mt-2">{{ $totalStudents }}</p>
                </div>

                <div class="bg-[#48426d] text-white rounded-lg p-6 shadow">
                    <h4 class="text-lg font-semibold">Available Rooms</h4>
                    <p class="text-3xl font-bold mt-2">{{ $availableRooms }}</p>
                </div>

                <div class="bg-[#48426d] text-white rounded-lg p-6 shadow">
                    <h4 class="text-lg font-semibold">Active Rentals</h4>
                    <p class="text-3xl font-bold mt-2">{{ $activeRentals }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
