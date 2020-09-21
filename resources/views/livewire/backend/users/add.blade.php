@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#roles').select2({
                placeholder: "Select Permission"
            });
            // $('#roles').on('change', function (e) {
            //     @this.set('rolesUser', e.target.value);
            // });
        });
    </script>
@endpush
<div>
    <tr>
        <form action="#" method="POST" wire:submit.prevent="addUser">
            <td></td>
            <td><input type="text" wire:model="name" class="form-control" placeholder="Name"> </td>
            <td><input type="text" wire:model="usename" class="form-control" placeholder="Username"> </td>
            <td><input type="text" wire:model="email" class="form-control" placeholder="Email"> </td>
            <td>
                <select wire-model="roles" class="form-control" id="roles" multiple>
                    @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </td>
            <td><button class="btn btn-success">Create</button></td>
        </form>
    </tr>
</div>
