<?php

namespace App\Livewire;

use App\Models\Student;
use App\Models\Tranning;
use Livewire\Component;

class ViewCertificate extends Component
{
    public $certificate;
    public $student;
    
    public function mount($id)
    {
        $student = Student::find($id);
        $this->certificate = $student?->certificate ?? '';
        $this->student = $student;
    }
    public function render()
    {
        return view('livewire.view-certificate')->layout('shared.auth');
    }
}
