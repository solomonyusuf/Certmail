<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class Register extends Component
{
    use Toastable;
    public $name = '';
    public $role = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'role' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => Hash::make($this->password),
        ]);

        $this->success('User Registration Successful');
        $this->redirectRoute('list_users');
    }

    public function render()
    {
        if(auth()->user()?->role == 'staff')
        {
            $this->error('Permission Denied');
            $this->redirectRoute('dashboard');
        }
        return view('livewire.auth.register')->layout('shared.layout');
    }
}
