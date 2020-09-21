<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Data Roles</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                @if (session()->has('message'))
                                    <div id="alert" class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <div class="alert-icon">
                                            <i class="far fa-fw fa-bell"></i>
                                        </div>
                                        <div class="alert-message">
                                            <strong>Success!</strong> {{session('message')}}!
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="form-inline">
                                    <span>Show perpage: &nbsp;</span>
                                    <select wire:model="perPage" class="form-control">
                                        <option value="5">5</option>
                                        <option value="25">15</option>
                                        <option value="50">25</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" wire:model="query" class="form-control" placeholder="Search Data Role...." >
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Guard Name</th>
                                                <th>Publish</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <form action="#" method="POST" wire:submit.prevent="{{$button ? 'addRole':'editRole'}}">
                                                    <td>Input Data : </td>
                                                    <td>
                                                        <input type="text" wire:model="name" class="form-control" placeholder="Input Name">
                                                        @error('name')
                                                            <div class="mt-2 text-danger">{{$message}}</div>
                                                        @enderror 
                                                    </td>
                                                    <td colspan="2"><input type="text" wire:model="guardName" class="form-control" placeholder="web"> </td>
                                                    <td><button class="btn btn-{{$button ? 'success' : 'info'}} btn-block"><i class="fas fa-user-{{$button ? 'plus' : 'edit'}}"></i> {{$button ?? 'Edit'}}</button></td>
                                                </form>
                                            </tr>
                                            @foreach ($roles as $index => $role)
                                            <tr>
                                                <td>{{$index + 1}}</td>
                                                <td>{{$role->name}}</td>
                                                <td>{{$role->guard_name}}</td>
                                                <td>{{$role->created_at->format("d F Y")}}</td>
                                                <td style="width: 110px">
                                                    <button data-toggle="modal" data-target="#centeredModalPrimary{{$role->id}}" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                                    <button wire:click.prevent="edit({{$role->id}})" class="btn btn-info"><i class="fas fa-edit"></i></button>
                                                    <div class="modal fade modal-colored modal-danger" id="centeredModalPrimary{{$role->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Role Name : {{$role->name}}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body m-3">
                                                                    <p class="mb-0">Apakah Anda Yakin Untuk Mendelete Role dengan nama : {{$role->name}} ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
                                                                    <button wire:click.prevent="removeRole({{$role}})" class="btn btn-light" data-dismiss="modal">Yes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-md-6">{{$roles->links()}}</div>
                                    <div class="col-md-6">
                                       <div class="text-right"> Show {{$roles->firstItem()}} to {{$roles->lastItem()}} from {{$roles->total()}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>