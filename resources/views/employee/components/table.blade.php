<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Province</th>
                <th>City</th>
                <th>Zip</th>
                <th>KTP</th>
                <th>Position</th>
                <th>Bank Account</th>
                <th>Account No</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->employee_id_number }}</td>
                    <td>{{ $employee->user->firstname }}</td>
                    <td>{{ $employee->user->lastname }}</td>
                    <td>{{ $employee->date_of_birth }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->user->email }}</td>
                    <td>{{ $employee->province_name }}</td>
                    <td>{{ $employee->city_name }}</td>
                    <td>{{ $employee->zip_code }}</td>
                    <td>{{ $employee->citizenship_id_no }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{ $employee->bank_account }}</td>
                    <td>{{ $employee->account_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>