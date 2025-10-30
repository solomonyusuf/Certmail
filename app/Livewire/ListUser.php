<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ListUser extends Component
{
    public function render()
    {
        $users = User::orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('livewire.list-user', compact('users'));
    }
}
