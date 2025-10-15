<?php

namespace App\Livewire;

use App\Models\Tranning;
use Illuminate\Http\Request;
use Livewire\Component;

class EditCertificate extends Component
{
    public $certificate;
    public $tranning;
    
    public function mount($id)
    {
        $trainning = Tranning::find($id);
        $this->certificate = json_decode($trainning->meta_data)?->certificate ?? '';
        $this->tranning = $trainning;
    }
    public function save(Request $request)
    {
        $trainning = Tranning::find($request->id);
        $meta = json_decode($trainning->meta_data);
        $meta->certificate = $request->content;
        $trainning->meta_data = json_encode($meta);
        $trainning->save();
        
        return redirect()->back();
    }
    
    public function render()
    {
        return view('livewire.edit-certificate');
    }
}
