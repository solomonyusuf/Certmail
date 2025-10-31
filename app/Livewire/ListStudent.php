<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Student;
use App\Models\Tranning;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Masmerise\Toaster\Toastable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;
use ZipArchive;

class ListStudent extends Component
{
    use WithPagination,Toastable, WithFileUploads;    

    public $excelFile, $zipFile;
    protected $paginationTheme = 'tailwind';

    public $search = ''; 
    public $id; 
    public $train; 
    public $certificate; 

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount($id)
    {
        $this->id = $id;
        $this->train = Tranning::find($id);
        $this->certificate = json_decode($this->train->meta_data)->certificate;
    }
    

    public function clear_all()
    {
        Student::where(['training_id'=> $this->id])->delete();
        $this->success('Removal Success');
        $this->resetPage();
    }

    public function save()
    {
        $this->validate([
           'excelFile' => 'required|mimes:xls,xlsx,csv|max:5120',      
        ]);

        $excelPath = $this->excelFile->store('uploads/excel', 'public');
        $excelFilePath = Storage::disk('public')->path($excelPath);

        $rows = Excel::toArray([], $excelFilePath)[0] ?? [];
 
        if (empty($rows) || count($rows) <= 1) {
            session()->flash('error', 'The Excel file appears to be empty or missing data.');
            return;
        }

        $added = 0;

        foreach ($rows as $index => $row) {
            if ($index === 0) continue;  

            $name  = trim($row[1] ?? '');
            $email = trim($row[2] ?? '');
            $nextId =  trim($row[0] ?? '');
            
            if (!$name || !$email) {
                logger("Skipped row $index: missing name or email");
                continue;
            }

            $check = Student::where(['cert_id'=> $nextId])->first();
            
            if($check)
            {
                $this->error("Student Certificate ID already exists");
                return;
            } 
            
            $certificate = $this->certificate;
            
            $certificate = str_replace(
                    ['[NAME]', '[COURSE]', '[INSTRUCTOR_NAME]', '[DATE]', '[CERTIFICATE_ID]'],
                    [
                        $name,
                        $this->train->title,
                        $this->train->instructor,
                        now()->format('F j, Y'),
                        strtoupper('NGA-'.substr($this->train->id, 0, 13))
                    ],
                    $certificate
                );
            $existing = Student::where('training_id', $this->id)
                ->where('email', $email)
                ->exists();

            if (!$existing) {
                Student::create([
                    'training_id' => $this->id,  
                    'name'        => $name,
                    'email'       => $email,
                    'cert_id'     => $nextId,
                    'certificate' => $certificate,
                ]);
            }
            else
            {
                $this->error("Student email already exists");
                return;
            }

            $added++;
        }

        
        logger("Total students added: $added");

        $this->success("Upload successful! $added students added.");
        $this->resetPage('excelFile');
    }

    public function download($id)
    {
        $path = public_path('logo.png');

        if (file_exists($path)) {
            $logoData = base64_encode(file_get_contents($path));
            $logoSrc = 'data:image/png;base64,' . $logoData;
        } else {
            $logoSrc = '';  
        }

        $student = Student::findOrFail($id);
        $name = $student->name;
        $html = html_entity_decode($student->certificate, ENT_QUOTES, 'UTF-8');
        $fileName = Str::slug($name) . '-certificate.pdf';
        $path = public_path("uploads/{$fileName}");
        $html = str_replace('src="logo.png"', 'src="' . $logoSrc . '"', $html);
        
        Browsershot::html($html)
            ->format('A3')
            ->landscape()
            ->margins(0, 0, 0, 0)
            ->timeout(900000)
            ->save($path);

        return response()->download($path)->deleteFileAfterSend(true);
    }

    public function render()
    {
        $students = Student::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->where(['training_id' => $this->id])
            ->orderBy('created_at', 'desc')
            ->paginate(200);

        return view('livewire.list-student', [
            'students' =>  $students
        ]);
    }
}
