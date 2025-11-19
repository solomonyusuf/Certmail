<?php

namespace App\Livewire;

use App\Models\Student;
use App\Models\Tranning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class EditTranning extends Component
{
    use Toastable;
    
    public $approve;

    public function sendCertificates(Request $request)
    {
        $request->validate([
            'training_id' => 'required',
            'content' => 'required|string',
        ]);

        $training = Tranning::findOrFail($request->training_id);
        $studentIds = collect($request->student);
        $students = Student::whereIn('id', $studentIds)->get();

        foreach ($students as $student) {
            // Prepare dynamic template
            $html = str_replace(
                ['[Student Name]', '[Training Program Name]', '[Date]', '[CERTIFICATE_DOWNLOAD_LINK]'],
                [
                    $student->name,
                    $training->title,
                    now()->format('F j, Y'),
                    route('view_certificate', $student->id) 
                ],
                $request->content
            );
            
            // Send mail using proper Mail::send syntax
            Mail::send('shared.certificate_mail', ['html' => $html], function ($message) use ($student, $training) {
                $message->to($student->email, $student->name)
                    ->subject("Your Certificate for {$training->title}");
            });
        }

        session()->remove('scope_otp');

        $this->success("Tranning Certificates Sent");
        
        return redirect()->route('trannings');
    }

    public function render()
    {
        $verifiedPages = session('lockscreen_verified_pages', []);

        // Check if this route is already approved
        if (isset($verifiedPages[request()->url()])) {
            $this->approve = true;
        }
        $trainings = Tranning::all();
        $studentsByTraining = $trainings->mapWithKeys(fn($t) => [
            $t->id => $t->students->map(fn($s) => ['id' => $s->id, 'name' => $s->name])
        ]);
        return view('livewire.edit-tranning', compact('trainings', 'studentsByTraining'));
    }
}
