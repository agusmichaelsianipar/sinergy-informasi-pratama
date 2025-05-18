<div class="modal fade" id="updateEmployeeModal" tabindex="-1" aria-labelledby="updateEmployeeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 px-2" id="updateEmployeeModalLabel">Edit Employee</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/employees') }}" id="updateEmployeeForm" class="p-2" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="employee_id" id="updateEmployeeID" value="">
                    <div class="row mb-0">
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="updateEmployeeFirstname">
                                    Firstname
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="firstname" id="updateEmployeeFirstname" class="form-control"
                                    required>
                                <div id="updateEmployeeFirstnameErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="updateEmployeeLastname">Lastname</label>
                                <input type="text" name="lastname" id="updateEmployeeLastname" class="form-control">
                                <div id="updateEmployeeLastnameErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="updateEmployeeGender">
                                    Gender
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="gender" id="updateEmployeeGender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <div id="updateEmployeeGenderErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="updateEmployeeDateOfBirth">
                                    Date of Birth
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="date_of_birth" id="updateEmployeeDateOfBirth"
                                    class="form-control" required>
                                <div id="updateEmployeeDateOfBirthErr" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="updateEmployeeEmail">
                                    Email
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="email" id="updateEmployeeEmail" class="form-control" required>
                                <div id="updateEmployeeEmailErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="updateEmployeePhoneNo">
                                    Phone No.
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="phone" id="updateEmployeePhoneNo" class="form-control"
                                    required>
                                <div id="updateEmployeePhoneNoErr" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="updateEmployeeCitizenshipIDNo">
                                    Citizenship ID Number
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="citizenship_id_no" id="updateEmployeeCitizenshipIDNo"
                                    class="form-control" required>
                                <div id="updateEmployeeCitizenshipIDNoErr" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="updateEmployeeCitizenshipIDFile">
                                    Citizenship ID File
                                    <span class="text-danger">*</span>
                                </label>
                                <img class="img-thumbnail" id="updateEmployeeCitizenshipIDFilePreview" src="#"
                                    style="display: none; max-height: 150px; min-height:120px; margin: auto;">
                                <input type="file" name="citizenship_id_file" id="updateEmployeeCitizenshipIDFile"
                                    onchange="previewCitizenshipIDFile()" accept="image/png, image/jpg, image/jpeg"
                                    class="form-control">
                                <div id="updateEmployeeCitizenshipIDFileErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" for="updateEmployeeStreet">
                            Street
                            <span class="text-danger">*</span>
                        </label>
                        <textarea name="street" id="updateEmployeeStreet" class="form-control" cols="10" rows="3"
                            required></textarea>
                        <div id="updateEmployeeStreetErr" class="invalid-feedback"></div>
                    </div>
                    <div class="row mb-0">
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="updateEmployeeProvince">
                                    Province
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="province" id="updateEmployeeProvince" class="form-control" required>
                                    <option value="">Select Province</option>
                                </select>
                                <div id="updateEmployeeProvinceErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="updateEmployeeCity">
                                    City
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="city" id="updateEmployeeCity" class="form-control" required>
                                    <option value="">Select City</option>
                                </select>
                                <div id="updateEmployeeCityErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="updateEmployeeZipCode">Zip Code
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="zip_code" id="updateEmployeeZipCode" class="form-control"
                                    required>
                                <div id="updateEmployeeZipCodeErr" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="fw-semibold" for="updateEmployeePosition">
                            Position
                            <span class="text-danger">*</span>
                        </label>
                        <select name="position" id="updateEmployeePosition" class="form-control" required>
                            <option value="">Select Position</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position }}">{{ $position }}</option>
                            @endforeach
                        </select>
                        <div id="updateEmployeePositionErr" class="invalid-feedback"></div>
                    </div>
                    <div class="row mb-0">
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="updateEmployeeBankAccount">
                                    Bank Account
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="bank_account" id="updateEmployeeBankAccount" class="form-control"
                                    required>
                                    <option value="">Select Bank Account</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank }}">{{ $bank }}</option>
                                    @endforeach
                                </select>
                                <div id="updateEmployeeBankAccountErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="updateEmployeeBankAccountNo">
                                    Bank Account No
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="account_number" id="updateEmployeeBankAccountNo"
                                    class="form-control" required>
                                <div id="updateEmployeeBankAccountNoErr" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary my-3 float-end">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>