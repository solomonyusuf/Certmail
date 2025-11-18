<?php

namespace App\Livewire;

use App\Models\Student;
use App\Models\Tranning;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Masmerise\Toaster\Toastable;

class Trannings extends Component
{
    use WithPagination,Toastable, WithFileUploads;    

     public $title, $instructor, $image, $date;

    protected $paginationTheme = 'tailwind';

    public $search = ''; 

    public function updatingSearch()
    {
        $this->resetPage();
    }
    protected $rules = [
        'title' => 'required|string|max:255',
        'instructor' => 'nullable|string',
        'date' => 'required|date',
        'image' => 'required',
    ];

    public function createTraining()
    {
        // Validate input
        $this->validate();

        if (Tranning::where('title', $this->title)->exists()) {
            $this->error( 'A training with this title already exists.');
            return;
        }
        else
        {
            
            $imagePath = null;
            if ($this->image) {
                $imagePath = $this->image->store('certificates', 'public');
            }

             // Save to DB
            $entity = Tranning::create([
                'title' => $this->title,
                'instructor' => $this->instructor ?? '',
                'date' => $this->date,
                'meta_data'=> json_encode([
                    'certificate' => $imagePath 
                ])
            ]);

            // Reset form
            $this->reset(['title', 'instructor', 'date']);

            $this->success('Training created successfully');

            // Refresh list automatically
            return $this->redirectRoute('edit_traning', $entity->id);
        }
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
