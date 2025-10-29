<div x-data="{ open: false }" class="min-h-screen bg-gray-100">

    <!-- Top Header -->
    <div class="px-8 py-4 max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800">{{ $train->title }} Students Overview</h1>
    </div>

    <!-- Dashboard Content -->
    <div class="p-8 max-w-7xl mx-auto space-y-8">
        <div class="mb-4 flex items-center gap-2">
            <!-- New Training Button -->
            <button type="button" @click="open = true"
                class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
                <!-- Plus Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                New Excel Students Upload
            </button>
           <a href="{{ route('edit_certificate', $train->id) }}"
                class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
                <!-- Eye Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Preview Certificate
             </a>

             
        </div>

        <!-- Training List Table -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Students List</h3>

            <!-- Search bar -->
            <div class="mb-4 flex items-center gap-2">
                <input type="text" wire:model.debounce.300ms="search" placeholder="Search trainings..."
                    class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">

                <!-- Clear All Button -->
                <button type="button"
                    x-on:click="if(confirm('Are you sure you want to clear all students?')) { $wire.clear_all() }"
                    class="flex items-center gap-1 px-3 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition">
                    <!-- Trash/Reset Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Clear All
                </button>
            </div>
            <div wire:loading>
                <div class="flex items-center justify-center py-10">
                    <div class="w-10 h-10 border-4 border-green-500 border-t-transparent rounded-full animate-spin">
                    </div>
                    <span class="ml-3 text-green-700">Please wait...</span>
                </div>
            </div>



            <div class="overflow-x-auto w-full">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#Student ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Certificate</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($students as $index => $student)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ substr($student->id, 0,13) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $student->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $student->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if($student->certificate)
                                <a target="__blank" href="{{ route('view_certificate', $student->id) }}"  
                                    class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
                                    <!-- Document Plus Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4v4m0 0h4m-4-4H8m4 4v8m4-12h-8a2 2 0 00-2 2v12a2 2 0 002 2h4a2 2 0 002-2v-4h2a2 2 0 002-2V8l-4-4z" />
                                    </svg>
                                    Certificate
                                </a>

                                @else
                                <span class="text-gray-400 italic">No certificate</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No students found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $students->links() }}
                </div>
            </div>
        </div>

        <!-- Modal (same Alpine scope as button) -->
        <div x-show="open" x-transition
            class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" style="display: none;">
            <div @click.away="open = false" class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Bulk Student Upload</h2>

                <!-- Form inside modal -->
               <form wire:submit="save" enctype="multipart/form-data" class="space-y-4">

                    <!-- Upload Section -->
                    <div>
                        <label class="font-medium text-gray-700">Upload Student Excel List</label>
                        <input 
                            type="file"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                                placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                            wire:model="excelFile"
                            accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv" 
                        />
                        @error('excelFile') 
                            <span class="text-sm text-red-600">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- ⚠️ Warning & Sample Template Section -->
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md flex items-start gap-3">
                        <svg class="w-6 h-6 text-yellow-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" 
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M13 16h-1v-4h-1m1-4h.01M12 9v2m0 4h.01M12 19a7 7 0 100-14 7 7 0 000 14z" />
                        </svg>
                        <div>
                            <p class="text-sm text-yellow-800 font-medium">
                                Please ensure your Excel file follows the correct format:
                            </p>
                            <ul class="list-disc list-inside text-sm text-yellow-700 mt-1">
                                <li>Column 1: Certificate ID</li>
                                <li>Column 2: Student Name</li>
                                <li>Column 3: Email</li>
                            </ul>
                            <p class="mt-2 text-sm text-gray-600">
                                You can download a sample Excel template 
                                <a href="{{ asset('templates/Students List.xlsx') }}" 
                                class="text-green-600 hover:underline font-medium">
                                here
                                </a>.
                            </p>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-start gap-2 mt-4">
                        <button 
                            type="button" 
                            @click="open = false"
                            class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit"
                            @click="open = false"
                            class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 flex items-center gap-2"
                        >
                            <svg wire:loading wire:target="save" class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span>Save</span>
                        </button>
                    </div>
                </form>


            </div>
        </div>

    </div>
</div>