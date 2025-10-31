<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Masmerise\Toaster\Toastable;

class Profile extends Component
{
    use Toastable, WithFileUploads;
    public $name;
    public $image;
    public $email;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->image = $user->image;
    }

    public function updateProfile()
    {
        $this->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable'
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('uploads', 'public');
        }

        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->image = $imagePath;

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        $this->success('Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
