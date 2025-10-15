<?php

namespace App\Livewire;

use App\Models\Student;
use App\Models\Tranning;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;    

    protected $paginationTheme = 'tailwind';

    public $search = ''; 

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Counts
        $totalStudents = Student::count();
        $totalUsers = User::count();
        $totalCertificates = Student::whereNotNull('certificate')->count();

        // Training list
        $trainings = Tranning::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('date', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('livewire.dashboard',  compact(
            'totalStudents',
            'totalUsers',
            'totalCertificates',
            'trainings'
        ));
    }
}
