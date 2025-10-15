<div x-data="{ open: false }" class="min-h-screen bg-gray-100">
  
  <!-- Top Header -->
  <div class="px-8 py-4 max-w-7xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800">Training Overview</h1>
  </div>

  <!-- Dashboard Content -->
  <div class="p-8 max-w-7xl mx-auto space-y-8">
    
    <!-- New Training Button -->
    <button 
      type="button"
      @click="open = true" 
      class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition"
    >
      <!-- Plus Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
      New Training
    </button>

    <!-- Training List Table -->
    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
      <h3 class="text-lg font-bold text-gray-800 mb-4">Training List</h3>
       <svg 
                wire:loading 
                class="animate-spin h-12 w-12 text-white"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
      <!-- Search bar -->
      <div class="mb-4">
        <input 
          type="text" 
          wire:model.debounce.300ms="search" 
          placeholder="Search trainings..." 
          class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-indigo-300"
        >
      </div>

      <div class="overflow-x-auto w-full">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Instructor</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse($trainings as $index => $training)
            <tr>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $trainings->firstItem() + $index }}</td>
              <td class="px-6 py-4 text-sm text-gray-900">{{ $training->title }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $training->instructor }}</td>
              <td class="px-6 py-4 text-sm text-gray-600">{{ $training->date }}</td>
              <td class="px-6 py-4 flex gap-2">
                <a  href="{{ route('edit_traning', $training->id) }}" class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                 View
                </a>
                <button x-on:click="if(confirm('Are you sure you want to clear training?')) { $wire.delete('{{ $training->id }}') }"
                type="button" class="px-4 py-2 rounded-lg border text-white-600 hover:bg-red-100">
                 Delete
                </button>
              </td>
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

    <!-- Modal (same Alpine scope as button) -->
    <div 
      x-show="open" 
      x-transition 
      class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50"
      style="display: none;"
    >
      <div 
        @click.away="open = false" 
        class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6"
      >
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Add New Training</h2>

        <!-- Form inside modal -->
        <form wire:submit.prevent="createTraining">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" wire:model="title" class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-indigo-200">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Instructor</label>
                <input type="text" wire:model="instructor" class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-indigo-200">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" wire:model="date" class="w-full border px-3 py-2 rounded-lg focus:ring focus:ring-indigo-200">
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" @click="open = false" class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                Cancel
                </button>
                <button 
                type="submit" 
                class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 flex items-center gap-2"
                wire:loading.attr="disabled"
            >
                <!-- Spinner -->
                <svg 
                    wire:loading 
                    wire:target="createTraining"
                    class="animate-spin h-4 w-4 text-white"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                >
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>

                <!-- Button Text -->
                <span wire:loading.remove wire:target="createTraining">Save</span>
                <span wire:loading wire:target="createTraining">Processing...</span>
            </button>
            </div>
        </form>
      </div>
    </div>

  </div>
</div>
