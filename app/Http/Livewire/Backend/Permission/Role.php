<?php

namespace App\Http\Livewire\Backend\Permission;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends Component
{
    use WithPagination;
    public $perPage  = 5;
    public $updatesQueryString = ['page'];
    public $query = '';

    public $name;
    public $guardName;
    public $roleId;
    public $button = 'Add';

    protected $listeners = ['render'];
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'max:225|min:2'
        ]);
    }

    public function edit($role)
    {
        $data = ModelsRole::find($role);
        $this->name = $data->name;
        $this->guardName = $data->guard_name;
        $this->button = null;
        $this->roleId = $data->id;
        $this->emit('render');
    }

    public function addRole()
    {
        $this->validate([
            'name' => 'required|max:225|min:2'
        ]);
        ModelsRole::create([
            'name' => $this->name,
            'guard_name' => $this->guardName ? $this->guardName : 'web'
        ]);
        $this->name = '';
        $this->guardName = '';
        session()->flash('message', 'Create Role Success!');
        $this->emit('render');
    }

    public function editRole()
    {
        $this->validate([
            'name' => 'required|max:225|min:2'
        ]);
        $data = ModelsRole::find($this->roleId);
        $data->update([
            'name' => $this->name,
            'guard_name' => $this->guardName ? $this->guardName : 'web'
        ]);
        $this->name = '';
        $this->guardName = '';
        $this->button = 'add';
        $this->roleId = null;
        session()->flash('message', 'Create Role Success!');
        $this->emit('render');
    }

    public function removeRole($role)
    {
        ModelsRole::destroy($role);
        session()->flash('message', 'Delete Role Success!');
        $this->emit('render');
    }

    public function render()
    {
        $roles = ModelsRole::where('name', 'like', "%$this->query%")
            ->orWhere('guard_name', 'like', "%$this->query%")
            ->latest()->paginate($this->perPage);
        $this->page > $roles->lastPage() ? $this->page = $roles->lastPage() : true;
        return view('livewire.backend.permission.role', [
            'roles' => $roles,
            'button' => $this->button
        ]);
    }
}
