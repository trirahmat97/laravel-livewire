<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Data Users</h1>
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
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" wire:model="query" class="form-control" placeholder="Search Data User...." >
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th style="width: 200px" >Role</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- insert form --}}
                                            <tr>
                                                <form action="#" id="form" method="POST" wire:submit.prevent="{{$button ? 'addUser':'editUser'}}">
                                                    <td>#</td>
                                                    <td>
                                                        <input type="text" wire:model="name" class="form-control" placeholder="Name">
                                                        @error('name')
                                                            <div class="mt-2 text-danger">{{$message}}</div>
                                                        @enderror  
                                                    </td>
                                                    <td>
                                                        <input type="text" wire:model="username" class="form-control" placeholder="Username">
                                                        @error('username')
                                                            <div class="mt-2 text-danger">{{$message}}</div>
                                                        @enderror 
                                                    </td>
                                                    <td>
                                                        <input type="email" wire:model="email" class="form-control" placeholder="Email">
                                                        @error('email')
                                                            <div class="mt-2 text-danger">{{$message}}</div>
                                                        @enderror  
                                                    </td>
                                                    <td>
                                                        {{-- {{$userRole}} --}}
                                                        <div>
                                                            <select wire:model="rolesUser" class="form-control">
                                                                <option selected value="">Select One Role ...</option>
                                                                @foreach ($roles as $role)
                                                                    @if ($user)
                                                                    {{-- <option>tra</option> --}}
                                                                        <option {{$user->roles()->find($role->id) ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                                                                    @else
                                                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-{{$button ? 'success' : 'info'}} btn-block"><i class="fas fa-user-{{$button ? 'plus' : 'edit'}}"></i> {{$button ?? 'Edit'}}</button>
                                                    </td>
                                                </form>
                                            </tr>
                                            {{-- end form --}}
                                            @foreach ($users as $index => $user)
                                            <tr>
                                                <td>{{$index + 1}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->username}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{implode(', ', $user->getRoleNames()->toArray())}}</td>
                                                <td style="width: 140px">
                                                    <button data-toggle="tooltip" data-placement="top" title="" data-original-title="Role" class="btn btn-success"><i class="fas fa-mars-stroke-v"></i></button>
                                                    <button data-toggle="modal" data-target="#centeredModalPrimary{{$user->id}}" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                                    <button wire:click.prevent="edit({{$user->id}})" id="edit" class="btn btn-info"><i class="fas fa-edit"></i></button>
                                                    <div class="modal fade modal-colored modal-danger" id="centeredModalPrimary{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete User Name : {{$user->name}}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body m-3">
                                                                    <p class="mb-0">Apakah Anda Yakin Untuk Delete User dengan nama : {{$user->name}} ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
                                                                    <button wire:click.prevent="deleteUser({{$user->id}})" class="btn btn-light" data-dismiss="modal">Yes</button>
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
                                    <div class="col-md-6">{{$users->links()}}</div>
                                    <div class="col-md-6">
                                       <div class="text-right"> Show {{$users->firstItem()}} to {{$users->lastItem()}} from {{$users->total()}}</div>
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