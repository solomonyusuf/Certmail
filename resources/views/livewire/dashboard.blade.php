<div class="min-h-screen bg-gray-100">

  <!-- Top Header -->
  <div class="">
    <div class="px-8 py-4 max-w-7xl mx-auto">
      <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
      <p class="text-sm text-gray-600 mt-1">Welcome back, {{ Auth::user()?->name }}</p>
    </div>
  </div>

  <!-- Dashboard Content -->
  <div class="p-8 max-w-7xl mx-auto space-y-8">

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 gap-6">

      <!-- Total Trainings Card -->
      <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-gray-600">Total Trainings</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalTranning }}</p>
          </div>
          <div class="bg-blue-100 rounded-full p-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
          </div>
        </div>
      </div>

      <!-- Total Users Card -->
      <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-gray-600">Total Users</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</p>
          </div>
          <div class="bg-purple-100 rounded-full p-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
        </div>
      </div>

    </div>


    <!-- Training List Table -->
    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
      <h3 class="text-lg font-bold text-gray-800 mb-4">Latest Training List</h3>

      <!-- Search bar -->
      <div class="mb-4">
        <input type="text" id="searchInput" placeholder="Search trainings..."
          class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
      </div>

      <div class="overflow-x-auto w-full">
        <table id="trainingsTable" class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instructor</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse($trainings as $index => $training)
            <tr>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $trainings->firstItem() + $index }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $training->title }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $training->instructor }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $training->date }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No trainings found</td>
            </tr>
            @endforelse
          </tbody>
        </table>
        <div class="mt-3">
          {{ $trainings->links() }}
        </div>
      </div>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("searchInput");
    const table = document.getElementById("trainingsTable");
    const rows = table.querySelectorAll("tbody tr");

    searchInput.addEventListener("keyup", () => {
      const query = searchInput.value.toLowerCase();

      rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(query) ? "" : "none";
      });
    });
  });
    </script>

  </div>
</div>