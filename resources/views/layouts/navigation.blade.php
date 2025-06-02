<nav class="w-64 min-h-screen shadow-md flex flex-col justify-between fixed left-0 top-0" style="background-color: #312C51; z-index: 1000;">
    <!-- Top Section: Logo and Navigation -->
    <div>
        <!-- Logo -->
        <div class="flex items-center justify-center h-20 border-b border-gray-700">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-10 w-auto fill-current text-white" />
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="mt-6 space-y-1 px-4">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center px-4 py-2 rounded-md text-white hover:bg-indigo-700">
                <i class="fas fa-tachometer-alt mr-3 w-5"></i> Dashboard
            </x-nav-link>
            <x-nav-link :href="route('students.index')" :active="request()->routeIs('students.index')" class="flex items-center px-4 py-2 rounded-md text-white hover:bg-indigo-700">
                <i class="fas fa-user-graduate mr-3 w-5"></i> Students
            </x-nav-link>
            <x-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.index')" class="flex items-center px-4 py-2 rounded-md text-white hover:bg-indigo-700">
                <i class="fas fa-door-open mr-3 w-5"></i> Rooms
            </x-nav-link>
            <x-nav-link :href="route('rentals.index')" :active="request()->routeIs('rentals.index')" class="flex items-center px-4 py-2 rounded-md text-white hover:bg-indigo-700">
                <i class="fas fa-file-signature mr-3 w-5"></i> Use a Room
            </x-nav-link>
        </div>
    </div>

    <!-- Bottom Section: User Profile and Logout -->
    <div class="px-4 py-6 border-t border-gray-700">
        <div class="flex items-center space-x-3">
            <img
                src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.jpg') }}"
                alt="Avatar"
                class="h-10 w-10 rounded-full object-cover border border-white"
            >
            <div>
                <div class="text-sm font-medium text-white">{{ Auth::user()->name }}</div>
                <div class="text-xs text-gray-300">{{ Auth::user()->email }}</div>
            </div>
        </div>

        <div class="mt-4 space-y-1">
            <x-nav-link :href="route('profile.edit')" class="flex items-center px-4 py-2 rounded-md text-white hover:bg-indigo-700">
                <i class="fas fa-user-cog mr-3 w-5"></i> Profile
            </x-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center px-4 py-2 rounded-md text-white hover:bg-red-600">
                    <i class="fas fa-sign-out-alt mr-3 w-5"></i> Log Out
                </x-nav-link>
            </form>
        </div>
    </div>
</nav>

<!-- Main content wrapper -->
<div class="ml-64">
    <!-- Your main content goes here -->
</div>
