<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Student') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
            <form action="{{ route('students.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ old('name', $student->name) }}" class="w-full mt-1 px-4 py-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Address</label>
                    <input type="text" name="address" value="{{ old('address', $student->address) }}" class="w-full mt-1 px-4 py-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Phone Number</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $student->phone_number) }}" class="w-full mt-1 px-4 py-2 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Gender</label>
                    <select name="gender" class="w-full mt-1 px-4 py-2 border rounded-md" required>
                        <option value="Male" {{ $student->gender === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $student->gender === 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block font-medium text-gray-700">Date of Birth</label>
                    <input type="date" name="dob" value="{{ old('dob', $student->dob) }}" class="w-full mt-1 px-4 py-2 border rounded-md" required>
                </div>

                <div class="text-right">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Update Student</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
