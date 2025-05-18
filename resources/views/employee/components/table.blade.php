<div class="table-responsive">
    <table class="table table-bordered table-striped" id="employeesTable">
        <thead>
            <tr>
                <th>Action</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Birth</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Province</th>
                <th>City</th>
                <th>Street</th>
                <th>Zip</th>
                <th>KTP</th>
                <th>Position</th>
                <th>Bank Account</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($employees as $employee)
                <tr>
                    <td class="text-center text-nowrap">
                        <ul class="list-inline d-inline-flex text-center">
                            <li class="list-inline-item" title="Edit Employee Data" style="line-height: 1;">
                                <a href="javascript:void(0)" data-employee="{{ $employee->id }}"
            data-url="/employees/{{ $employee->employee_id_number }}"
            data-firstname="{{ $employee->user->firstname }}"
            data-lastname="{{ $employee->user->lastname }}" data-gender="{{ $employee->gender }}"
            data-date_of_birth="{{ $employee->date_of_birth }}"
            data-email="{{ $employee->user->email }}" data-phone="{{ $employee->phone }}"
            data-citizenship_id_no="{{ $employee->citizenship_id_no }}"
            data-citizenship_id_file="{{ url('/storage/' . $employee->citizenship_id_file) }}"
            data-street="{{ $employee->street }}" data-province="{{ $employee->province_id }}"
            data-city="{{ $employee->city_id }}" data-zip_code="{{ $employee->zip_code }}"
            data-position="{{ $employee->position }}"
            data-bank_account="{{ $employee->bank_account }}"
            data-account_number="{{ $employee->account_number }}"
            class="text-warning text-decoration-none mx-1" data-bs-toggle="modal"
            data-bs-target="#updateEmployeeModal" style="font-size: 0.90rem;">
            <i class="fa-solid fa-pen-to-square"></i>
            </a>
            </li>
            <li class="list-inline-item" title="Delete Employee Data" style="line-height: 1;">
                <a href="#" data-url="/employees/{{ $employee->employee_id_number }}"
                    onclick="showDeleteAlert(`/employees/{{ $employee->employee_id_number }}`)"
                    class="text-danger text-decoration-none mx-1" style="font-size: 0.90rem;">
                    <i class="fa fa-trash"></i>
                </a>
            </li>
            </ul>
            </td>
            <td>{{ $employee->employee_id_number }}</td>
            <td>{{ $employee->user->firstname }} {{ $employee->user->lastname }}</td>
            <td>
                {{ $employee->date_of_birth ? Carbon\Carbon::parse($employee->date_of_birth)->format('d/m/Y') : '' }}
            </td>
            <td>{{ $employee->phone }}</td>
            <td>{{ $employee->user->email }}</td>
            <td>{{ $employee->province_name }}</td>
            <td>{{ $employee->city_name }}</td>
            <td>{{ $employee->street }}</td>
            <td>{{ $employee->zip_code }}</td>
            <td class="text-center">
                <a href="javascript:void(0)"
                    data-citizenship_id_file="{{ url('/storage/' . $employee->citizenship_id_file) }}"
                    data-bs-toggle="modal" data-bs-target="#showImageModal">
                    See File
                    <i class="fa-solid fa-eye"></i>
                </a>
                <br>
                {{ $employee->citizenship_id_no }}
            </td>
            <td>{{ $employee->position }}</td>
            <td class="text-center">
                {{ $employee->bank_account }}
                <br>
                {{ $employee->account_number }}
            </td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>
</div>