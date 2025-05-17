<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
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
            @foreach ($employees as $employee)
                <tr>
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
            @endforeach
        </tbody>
    </table>
</div>