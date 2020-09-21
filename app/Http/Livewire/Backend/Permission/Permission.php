<?php

namespace App\Http\Livewire\Backend\Permission;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends Component
{
    use WithPagination;
    public $perPage  = 5;
    public $updatesQueryString = ['page'];
    public $query = '';

    public $name;
    public $guardName;
    public $permissionId;
    public $button = 'Add';

    public $checkboxAll = false;
    public $checkbox = [];
    public $showDelete = false;

    protected $listeners = ['render'];
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'max:225|min:2'
        ]);
    }

    public function checkAll()
    {
        $this->checkboxAll = !$this->checkboxAll;
        $this->checkbox = $this->checkboxAll;
        if ($this->checkboxAll || $this->checkbox) {
            $this->showDelete = true;
        } else {
            $this->showDelete = false;
        }
        $this->emit('render');
    }

    public function check()
    {
        $this->checkbox = !$this->checkbox;
        if ($this->checkboxAll || $this->checkbox) {
            $this->showDelete = true;
        } else {
            $this->showDelete = false;
        }
        $this->emit('render');
    }

    public function edit($permission)
    {
        $data = ModelsPermission::find($permission);
        $this->name = $data->name;
        $this->guardName = $data->guard_name;
        $this->button = null;
        $this->permissionId = $data->id;
        $this->emit('render');
    }

    public function addPermission()
    {
        $this->validate([
            'name' => 'required|max:225|min:2'
        ]);
        ModelsPermission::create([
            'name' => $this->name,
            'guard_name' => $this->guardName ? $this->guardName : 'web'
        ]);
        $this->name = '';
        $this->guardName = '';
        session()->flash('message', 'Create Permission Success!');
        $this->emit('render');
    }

    public function editPermission()
    {
        $this->validate([
            'name' => 'required|max:225|min:2'
        ]);
        $data = ModelsPermission::find($this->permissionId);
        $data->update([
            'name' => $this->name,
            'guard_name' => $this->guardName ? $this->guardName : 'web'
        ]);
        $this->name = '';
        $this->guardName = '';
        $this->button = 'add';
        $this->permissionId = null;
        session()->flash('message', 'Create Permission Success!');
        $this->emit('render');
    }

    public function removePermission($permission)
    {
        ModelsPermission::destroy($permission);
        session()->flash('message', 'Delete Permission Success!');
        $this->emit('render');
    }

    public function render()
    {
        $permissions = ModelsPermission::where('name', 'like', "%$this->query%")
            ->orWhere('guard_name', 'like', "%$this->query%")
            ->latest()->paginate($this->perPage);
        $this->page > $permissions->lastPage() ? $this->page = $permissions->lastPage() : true;
        return view('livewire.backend.permission.permission', [
            'permissions' => $permissions,
            'title' => 'Permissions',
            'button' => $this->button,
            'showDelete' => $this->showDelete
        ]);
    }
}
