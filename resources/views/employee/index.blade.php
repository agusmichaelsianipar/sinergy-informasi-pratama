@extends('template.app')
@section('title', "Employee Management")
@section('content')

    <div class="container py-3">
        <div class="card">
            <div class="card-header py-3">
                <p class="h5">Employee Managements</p>
            </div>
            <div class="card-body">
                {{-- Add Employee Button --}}
                <button type="button" class="btn btn-sm btn-outline-primary mb-2" data-bs-toggle="modal"
                    data-bs-target="#createEmployeeModal">
                    <i class="fa-solid fa-plus"></i>
                    Add Employee
                </button>

                {{-- Employee Table --}}
                @include('employee.components.table')
            </div>
        </div>
    </div>

    @include('employee.components.showImageModal')
    @include('employee.components.createEmployeeModal')
    @include('employee.components.updateEmployeeModal')
@endsection


@push('addon-script')
    <script type="text/javascript" src="{{ asset('assets/js/showEmployee.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/createEmployee.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/updateEmployee.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/deleteEmployee.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endpush