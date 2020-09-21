<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">{{$title ?? 'Title Not Found!'}}</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if (session()->has('message'))
                            <div id="alert" class="alert alert-success alert-dismissible" permission="alert">
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
                    <div class="card-body">
                        <div class="row">
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
                                <input type="text" wire:model="query" class="form-control" placeholder="Search Data Permission...." >
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Guard Name</th>
                                                <th>Create At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <form action="#" method="POST" wire:submit.prevent="{{$button ? 'addPermission':'editPermission'}}">
                                                    <td>
                                                       Input Data:
                                                    </td>
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
                                            @foreach ($permissions as $index => $permission)
                                            <tr>
                                                <td style="width: 50px">
                                                    <center>{{$index + 1}}</center>
                                                </td>
                                                <td>{{$permission->name}}</td>
                                                <td>{{$permission->guard_name}}</td>
                                                <td>{{$permission->created_at->format("d F Y")}}</td>
                                                <td style="width: 110px">
                                                    <button data-toggle="modal" data-target="#centeredModalPrimary{{$permission->id}}" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                                    <button wire:click.prevent="edit({{$permission->id}})" class="btn btn-info"><i class="fas fa-edit"></i></button>
                                                    <div class="modal fade modal-colored modal-danger" id="centeredModalPrimary{{$permission->id}}" tabindex="-1" permission="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" permission="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete permission Name : {{$permission->name}}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body m-3">
                                                                    <p class="mb-0">Apakah Anda Yakin Untuk Mendelete Permission dengan nama : {{$permission->name}} ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
                                                                    <button wire:click.prevent="removePermission({{$permission}})" class="btn btn-light" data-dismiss="modal">Yes</button>
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
                                    <div class="col-md-6">{{$permissions->links()}}</div>
                                    <div class="col-md-6">
                                       <div class="text-right"> Show {{$permissions->firstItem()}} to {{$permissions->lastItem()}} from {{$permissions->total()}}</div>
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