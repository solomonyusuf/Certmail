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

        // Check if a file was uploaded
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Generate a unique filename
            $filename = time() . '_' . $file->getClientOriginalName();

            // Move the file to public/uploads
            $file->move(public_path('uploads'), $filename);

            // Store the relative path in meta
            $meta->certificate = 'uploads/' . $filename;
        }
 
        $trainning->meta_data = json_encode($meta);
        $trainning->save();

        return redirect()->back()->with('success', 'Certificate saved successfully!');
    }

    
    public function render()
    {
        return view('livewire.edit-certificate');
    }
}
