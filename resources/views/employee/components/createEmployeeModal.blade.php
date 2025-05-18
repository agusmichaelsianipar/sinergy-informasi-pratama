<div class="modal fade" id="createEmployeeModal" tabindex="-1" aria-labelledby="createEmployeeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 px-2" id="createEmployeeModalLabel">Add New Employee</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/employees') }}" id="createEmployeeForm" class="p-2" method="post">
                    @csrf
                    <div class="row mb-0">
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="createEmployeeFirstname">
                                    Firstname
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="firstname" id="createEmployeeFirstname" class="form-control"
                                    required>
                                <div id="createEmployeeFirstnameErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="createEmployeeLastname">Lastname</label>
                                <input type="text" name="lastname" id="createEmployeeLastname" class="form-control">
                                <div id="createEmployeeLastnameErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="createEmployeeGender">
                                    Gender
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="gender" id="createEmployeeGender" class="form-control" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <div id="createEmployeeGenderErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="createEmployeeDateOfBirth">
                                    Date of Birth
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="date_of_birth" id="createEmployeeDateOfBirth"
                                    class="form-control" required>
                                <div id="createEmployeeDateOfBirthErr" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="createEmployeeEmail">
                                    Email
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="email" id="createEmployeeEmail" class="form-control" required>
                                <div id="createEmployeeEmailErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="createEmployeePhoneNo">
                                    Phone No.
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="phone" id="createEmployeePhoneNo" class="form-control"
                                    required>
                                <div id="createEmployeePhoneNoErr" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="createEmployeeCitizenshipIDNo">
                                    Citizenship ID Number
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="citizenship_id_no" id="createEmployeeCitizenshipIDNo"
                                    class="form-control" data-type="number" max_length="16" minlength="16" required>
                                <div id="createEmployeeCitizenshipIDNoErr" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="createEmployeeCitizenshipIDFile">
                                    Citizenship ID File
                                    <span class="text-danger">*</span>
                                </label>
                                <img class="img-thumbnail" id="createEmployeeCitizenshipIDFilePreview" src="#"
                                    style="display: none; max-height: 150px; min-height:120px; margin: auto;">
                                <input type="file" name="citizenship_id_file" id="createEmployeeCitizenshipIDFile"
                                    onchange="previewCitizenshipIDFile()" accept="image/png, image/jpg, image/jpeg"
                                    class="form-control" required>
                                <div id="createEmployeeCitizenshipIDFileErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-semibold" for="createEmployeeStreet">
                            Street
                            <span class="text-danger">*</span>
                        </label>
                        <textarea name="street" id="createEmployeeStreet" class="form-control" cols="10"
                            rows="3"></textarea>
                        <div id="createEmployeeStreetErr" class="invalid-feedback"></div>
                    </div>
                    <div class="row mb-0">
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="createEmployeeProvince">
                                    Province
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="province" id="createEmployeeProvince" class="form-control">
                                    <option value="">Select Province</option>
                                </select>
                                <div id="createEmployeeProvinceErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="createEmployeeCity">
                                    City
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="city" id="createEmployeeCity" class="form-control">
                                    <option value="">Select City</option>
                                </select>
                                <div id="createEmployeeCityErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="createEmployeeZipCode">Zip Code
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="zip_code" id="createEmployeeZipCode" class="form-control"
                                    data-type="number">
                                <div id="createEmployeeZipCodeErr" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="fw-semibold" for="createEmployeePosition">
                            Position
                            <span class="text-danger">*</span>
                        </label>
                        <select name="position" id="createEmployeePosition" class="form-control">
                            <option value="">Select Position</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position }}">{{ $position }}</option>
                            @endforeach
                        </select>
                        <div id="createEmployeePositionErr" class="invalid-feedback"></div>
                    </div>
                    <div class="row mb-0">
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="createEmployeeBankAccount">
                                    Bank Account
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="bank_account" id="createEmployeeBankAccount" class="form-control">
                                    <option value="">Select Bank Account</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank }}">{{ $bank }}</option>
                                    @endforeach
                                </select>
                                <div id="createEmployeeBankAccountErr" class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="fw-semibold" for="createEmployeeBankAccountNo">
                                    Bank Account No
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="account_number" id="createEmployeeBankAccountNo"
                                    class="form-control" data-type="number">
                                <div id="createEmployeeBankAccountNoErr" class="invalid-feedback">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="createEmployeeSubmitButton" class="btn btn-primary my-3 float-end">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>