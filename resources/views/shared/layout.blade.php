<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'CertMail' }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
  @livewireStyles
</head>
<body class="bg-gray-100 flex ">

  <!-- Sidebar -->
  <aside class="w-64 min-h-screen bg-white shadow-lg flex flex-col">
    
    <!-- Logo -->
    <div class="p-6 border-b border-gray-200 flex justify-center">
      <img src="{{ asset('logo.png') }}" alt="Logo" class="w-16 h-auto object-contain" />
    </div>

    <!-- User Profile -->
    <div class="p-6 border-b border-gray-200">
      <div class="flex flex-col items-center">
        <div class="w-20 h-20 rounded-full bg-gray-300 overflow-hidden mb-3">
          <img src="{{ Auth::user()?->image ?? 'https://img.icons8.com/?size=100&id=7819&format=png&color=000000'}}" 
               alt="User Avatar" 
               class="w-full h-full object-cover">
        </div>
        <h3 class="text-lg font-semibold text-gray-800">{{ Auth::user()?->name }}</h3>
        <p class="text-sm text-gray-500 mt-1">{{ Auth::user()?->email }}</p>
      </div>
    </div>
    
    <!-- Navigation -->
    <nav class="flex-1 px-4 py-4 space-y-2">
      
      <!-- Dashboard -->
     <a href="{{ route('dashboard') }}" 
   class="flex items-center space-x-3 p-3 rounded-lg transition-colors 
          {{ Route::is('dashboard') 
             ? 'bg-green-200 text-green-600 font-bold' 
             : 'text-gray-700 hover:bg-gray-100' }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
    </svg>
    <span class="font-medium">Dashboard</span>
    </a>

      
      <!-- Trainings -->
      <a href="{{ route('trannings') }}" class="{{ Route::is('trannings') 
             ? 'bg-green-200 text-green-600 font-bold' 
             : 'text-gray-700 hover:bg-gray-100' }} flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m-6-6v6m12-6v6" />
        </svg>
        <span class="font-medium">Trainings</span>
      </a>
      
      <a href="{{ route('mail') }}" 
          class="{{ Route::is('mail') 
                    ? 'bg-green-200 text-green-600 font-bold' 
                    : 'text-gray-700 hover:bg-gray-100' }} 
                  flex items-center space-x-3 p-3 rounded-lg transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
              viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M16 12h2m-6 0h2m-6 0h2m2-8h8a2 2 0 012 2v12a2 2 0 
                    01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2l2-2h4l2 2z" />
          </svg>
          <span class="font-medium">Compose Mail</span>
        </a>
        <a href="{{ route('list_users') }}" 
            class="{{ Route::is('list_users') 
                      ? 'bg-green-200 text-green-600 font-bold' 
                      : 'text-gray-700 hover:bg-gray-100' }} 
                    flex items-center space-x-3 p-3 rounded-lg transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
                viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="font-medium">List Users</span>
          </a>

        <a href="{{ route('register') }}" 
          class="{{ Route::is('register') 
                    ? 'bg-green-200 text-green-600 font-bold' 
                    : 'text-gray-700 hover:bg-gray-100' }} 
                  flex items-center space-x-3 p-3 rounded-lg transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
              viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
          </svg>
          <span class="font-medium">Create User</span>
        </a>
      
        <a href="{{ route('profile') }}" 
          class="{{ Route::is('profile') 
                  ? 'bg-green-200 text-green-600 font-bold' 
                  : 'text-gray-700 hover:bg-gray-100' }} 
                  flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
            viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                d="M5.121 17.804A7 7 0 0112 15a7 7 0 016.879 2.804M12 12a4 4 0 100-8 4 4 0 000 8z" />
        </svg>
          <span class="font-medium">Profile</span>
        </a>
      <div class="p-4 border-t border-gray-200">
      <a href="{{ route('logout') }}" class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
        </svg>
        <span class="font-medium">Logout</span>
      </a>
    </div>
    </nav>
    
    <!-- Logout -->
    
    
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-8 overflow-y-auto">
    {{ $slot }}
  </main>
   <x-toaster-hub />
  @livewireScripts
  @filepondScripts

</body>
</html>
