<?php

namespace App\Livewire;

use App\Models\Student;
use App\Models\Tranning;
use Livewire\Component;
use Carbon\Carbon;

class ViewCertificate extends Component
{
    public $certificate;
    public $student;
    public $tranning;
    public $formattedDate;
    
    public function mount($id)
    {
        $student = Student::find($id);
        $this->certificate = json_decode($student?->tranning?->meta_data)->certificate ?? '';
        $this->student = $student;
        $this->tranning = $student?->tranning;
        $this->formattedDate = Carbon::parse($this->tranning->date)->format('F Y');
    }
    public function render()
    {
        return view('livewire.view-certificate')->layout('shared.auth');
    }
}
