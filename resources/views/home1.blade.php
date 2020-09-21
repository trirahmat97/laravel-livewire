@extends('layouts.app')
@push('scripts')
<script>
// $(document).ready(function() {
//     $('#roles').select2({
//         placeholder: 'Select Role User',
//         maximumSelectionLength: 2,
//     });
//     $('#roles').on('change', function (e) {
//         var data = $('#roles').select2("val");
//         @this.set('rolesUser', data);
//     });

//     $("#form").on("submit", function () {
//         setTimeout(() => {
//             $('#roles').val(null).trigger('change');
//             $('#roles2').val(null).trigger('change');
//         }, 200);
//     });
// });

$(document).ready(function() {
        $('#roles').select2();
        $('#roles').on('change', function (e) {
            @this.set('rolesUser', e.target.value);
        });
        $("#form").on("submit", function () {
            setTimeout(() => {
                $('#roles').val(null).trigger('change');
            }, 200);
        });
    });
</script>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
