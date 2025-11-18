<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <style>
        body{
            background:url('templates/bg.jpg') center;
        }
    </style>
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl shadow-xl">
        <div class="flex flex-col items-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="h-16 w-24 object-contain" />
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
               .NG Academy Certificate Generator
            </h2>
            <p class="mt-2 text-center text-gray-600">
                Sign in to Certmailer
            </p>
        </div>

        <form class="mt-8 space-y-6" wire:submit="login">
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                    <input wire:model="email" id="email" name="email" type="email" required 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input wire:model="password" id="password" name="password" type="password" required 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm">
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input wire:model="remember" id="remember" name="remember" type="checkbox" 
                        class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        Remember me
                    </label>
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-semibold rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-200 ease-in-out">
                    <svg wire:loading viewBox="0 0 50 50" width="30" height="30" class="green-spinner" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <circle class="bg" cx="25" cy="25" r="20" fill="none" stroke="#e6f4ea" stroke-width="5"/>
                        <circle class="spinner" cx="25" cy="25" r="20" fill="none" stroke="#16a34a" stroke-width="5" stroke-linecap="round"
                                stroke-dasharray="90 150" stroke-dashoffset="0"/>
                    </svg>

                    Sign in
                </button>
            </div>

            
        </form>
    </div>
</div>
