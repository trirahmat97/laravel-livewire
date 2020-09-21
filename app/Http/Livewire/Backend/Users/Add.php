<?php

namespace App\Http\Livewire\Backend\Users;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Add extends Component
{
    public function render()
    {
        $roles = Role::get();
        return view('livewire.backend.users.add', compact('roles'));
    }
}
