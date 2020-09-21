<?php

namespace App\Http\Livewire\Backend\Users;

use App\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Index extends Component
{
    use HasRoles;
    use WithPagination;
    public $perPage  = 5;
    public $updatesQueryString = ['page'];
    public $query = '';
    public $button = 'Add';

    public $name;
    public $username;
    public $email;
    public $rolesUser;
    public $userId;
    public $user;
    public $userRole = [];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|max:225|min:2',
            'username' => 'required|max:225|min:5',
            'email' => 'required|email'
        ]);
    }

    public function edit($user)
    {
        $data = User::find($user);
        $this->name = $data->name;
        $this->username = $data->username;
        $this->email = $data->email;
        $this->button = null;
        $this->userId = $data->id;
        $this->user = $data;
        // $this->userRole = $data->getRoleNames();
        // // dd($data->getRoleNames());
        $this->emit('render');
    }

    public function deleteUser($user)
    {
        $user = User::find($user);
        $role = $user->getRoleNames();
        if (count($role) > 0) {
            $user->syncRoles();
            $user->delete();
        } else {
            $user->delete();
        }
        session()->flash('message', 'Delete User Success!');
        $this->emit('render');
    }

    public function addUser()
    {
        $this->validate([
            'name' => 'required|max:225|min:2',
            'username' => 'required|max:225|min:5',
            'email' => 'required|email'
        ]);
        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => '$2y$10$UYbAGow68e0E7xNQKokLJ.hl9Qzb6GMZpBgHArD3sCa2S.5PTjrc.',
        ]);
        if (!is_null($this->rolesUser)) {
            $user->assignRole($this->rolesUser);
        }
        $this->name = '';
        $this->email = '';
        $this->username = '';
        $this->rolesUser = null;
        // $this->wire = true;
        session()->flash('message', 'Create User Success!');
        $this->emit('render');
    }

    public function render()
    {
        $users = User::where('name', 'like', "%$this->query%")
            ->orWhere('username', 'like', "%$this->query%")
            ->orWhere('name', 'like', "%$this->query%")
            ->orWhere('email', 'like', "%$this->query%")
            ->latest()->paginate($this->perPage);
        $this->page > $users->lastPage() ? $this->page = $users->lastPage() : true;
        $roles = Role::get();
        return view('livewire.backend.users.index', [
            'user' => $this->user,
            'users' => $users,
            'roles' => $roles,
            'button' => $this->button,
            'userRole' => $this->userRole
        ]);
    }
}
