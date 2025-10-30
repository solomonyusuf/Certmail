<div x-data="{ open: false }" class="min-h-screen bg-gray-100">

  <!-- Top Header -->
  <div class="px-8 py-4 max-w-7xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800">Users Overview</h1>
  </div>

  <!-- Dashboard Content -->
  <div class="p-8 max-w-7xl mx-auto space-y-8">

    <!-- New Training Button -->
    <a href="{{ route('register') }}" 
      style="width:200px;"
      class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
      <!-- Plus Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      New User
    </a>

    <!-- Training List Table -->
    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
      <h3 class="text-lg font-bold text-gray-800 mb-4">Users List</h3>
      <svg wire:loading class="animate-spin h-12 w-12 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
      </svg>
      <!-- Search bar -->
      <div class="mb-4">
        <input type="text" id="searchInput" placeholder="Search trainings..."
          class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
      </div>

      <div class="overflow-x-auto w-full">
        <table id="trainingsTable" class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse($users as $index => $user)
            <tr>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $index+1 }}</td>
              <td class="px-6 py-4 text-sm text-gray-900  flex gap-2">
                 <div class="px-3"> 
                    <img src="{{ asset($user->image ?? 'https://img.icons8.com/?size=100&id=7819&format=png&color=000000') }}" style="height:50px;width:50px;border-radius:25px;" />
                </div>
                {{ $user->name }}
            </td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
              <td class="px-6 py-4 flex gap-2">
                @if($user->email != 'Tech_support@nira.org.ng')
                <a href="{{ route('delete_user', $user->id) }}"
                  class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                  Delete
                </a>
                @endif
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No Users found</td>
            </tr>
            @endforelse
          </tbody>
        </table>
        <div class="mt-3">
          {{ $users->links() }}
        </div>
      </div>
    </div>

 

  </div>

</div>