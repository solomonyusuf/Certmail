<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class Login extends Component
{
    use Toastable;
     public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            $this->success('Login Success');
            return redirect()->route('lock_page');
        }

        $this->addError('email', 'The provided credentials do not match our records.');

        $this->error('The provided credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('shared.auth');
    }
}
