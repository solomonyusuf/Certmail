<?php

namespace App\Livewire;

use App\Models\Student;
use App\Models\Tranning;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toastable;

class Trannings extends Component
{
    use WithPagination,Toastable;    

     public $title, $instructor, $date;

    protected $paginationTheme = 'tailwind';

    public $search = ''; 

    public function updatingSearch()
    {
        $this->resetPage();
    }
    protected $rules = [
        'title' => 'required|string|max:255',
        'instructor' => 'required|string|max:255',
        'date' => 'required|date',
    ];

    public function createTraining()
    {
        // Validate input
        $this->validate();

        // Save to DB
        $entity = Tranning::create([
            'title' => $this->title,
            'instructor' => $this->instructor,
            'date' => $this->date,
            'meta_data'=> json_encode([
                'certificate' =>  file_get_contents(public_path('templates/template.html')) 
            ])
        ]);

        // Reset form
        $this->reset(['title', 'instructor', 'date']);

        $this->success('Training created successfully');

        // Refresh list automatically
        $this->redirectRoute('edit_traning', $entity->id);
    }

    public function delete($id)
    {
        Student::where(['training_id'=> $id])->delete();
        Tranning::find($id)->delete();
        $this->success('Removal Success');
        $this->resetPage();
    }
    public function render()
    {
        // Training list
        $trainings = Tranning::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('date', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('livewire.trannings',   compact(
            'trainings'
        ));
    }
}
