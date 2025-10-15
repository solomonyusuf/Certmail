<div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-bold mb-4">My Profile</h2>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="space-y-4">
        <!-- Name -->
        <div>
            <label class="block text-sm font-medium">Name</label>
            <input type="text" wire:model="name"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-300">
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" wire:model="email"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-300">
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div>
            <label class="block text-sm font-medium">New Password</label>
            <input type="password" wire:model="password"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-300">
            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-sm font-medium">Confirm Password</label>
            <input type="password" wire:model="password_confirmation"
                   class="w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-300">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                Save Changes
            </button>
        </div>
    </form>
</div>
