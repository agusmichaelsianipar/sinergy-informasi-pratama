@extends('template.app')
@section('title', "Employee Management")
@section('content')

    <div class="container py-3">
        <div class="card">
            <div class="card-header py-3">
                <p class="h5">Employee Managements</p>
            </div>
            <div class="card-body">
                {{-- Employee Table --}}
                @include('employee.components.table')
            </div>
        </div>
    </div>

@endsection


@push('addon-script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endpush