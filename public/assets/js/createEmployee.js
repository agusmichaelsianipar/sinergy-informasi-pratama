$("#createEmployeeForm").validate({
    errorElement: "span",
    errorClass: "help-block",
    highlight: function (element, errorClass, validClass) {
        $(element).addClass("is-invalid");
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass("is-invalid");
    },
    errorPlacement: function (error, element, errorClass) {
        if (element.hasClass("select2-hidden-accessible")) {
            error.insertAfter(element.next(".select2-container"));
        } else if (element.parent(".input-group").length) {
            error.insertAfter(element.parent());
        } else {
            error.addClass("text-danger");
            error.addClass("invalid-feedback");
            error.insertAfter(element);
        }
    },
    rules: {
        email: {
            required: true,
            email: true,
        },
        date_of_birth: {
            required: true,
            date: true,
        },
        phone: {
            required: true,
            minlength: 10,
            maxlength: 18,
            numericdashes: true,
        },
        citizenship_id_no: {
            required: true,
            digits: true,
            minlength: 16,
            maxlength: 16,
        },
        citizenship_id_file: {
            required: true,
        },
        zip_code: {
            required: false,
            digits: true,
            maxlength: 10,
        },
        account_number: {
            required: false,
            digits: true,
            minlength: 5,
            maxlength: 30,
        },
    },
    submitHandler: function (form) {
        $("#preloder").fadeIn();

        $("#createEmployeeSubmitButton").prop("disabled", true);

        let formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: `/employees`,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#createEmployeeSubmitButton").prop("disabled", false);

                $("#createEmployeeModal").modal("hide");

                $("#preloder").fadeOut("normal", function () {
                    $(this).hide();
                });
                Swal.fire({
                    toast: true,
                    icon: "success",
                    title: response.message,
                    position: "bottom-end",
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    },
                });

                $("#employeesTable").DataTable().ajax.reload();
            },
            error: function (error) {
                $("#createEmployeeSubmitButton").prop("disabled", false);
                $("#preloder").fadeOut("normal", function () {
                    $(this).hide();
                });
                if (error.status == 422) {
                    Swal.fire({
                        toast: true,
                        icon: "error",
                        title: "Data invalid!",
                        position: "bottom-end",
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        },
                    });
                    let err = error.responseJSON.errors;
                    if (typeof err.firstname !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeeFirstnameErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.firstname[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("input[name='firstname']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeeFirstnameErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("input[name='firstname']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.lastname !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeeLastnameErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.lastname[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("input[name='lastname']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeeLastnameErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("input[name='lastname']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.gender !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeeGenderErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.gender[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("select[name='gender']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeeGenderErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("select[name='gender']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.date_of_birth !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeeDateOfBirthErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.date_of_birth[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("input[name='date_of_birth']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeeDateOfBirthErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("input[name='date_of_birth']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.email !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeeEmailErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.email[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("input[name='email']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeeEmailErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("input[name='email']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.phone !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeePhoneNoErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.phone[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("input[name='phone']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeePhoneNoErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("input[name='phone']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.citizenship_id_no !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeeCitizenshipIDNoErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.citizenship_id_no[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("input[name='citizenship_id_no']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeeCitizenshipIDNoErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("input[name='citizenship_id_no']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.citizenship_id_file !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeeCitizenshipIDFileErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.citizenship_id_file[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("input[name='citizenship_id_file']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeeCitizenshipIDFileErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("input[name='citizenship_id_file']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.street !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeeStreetErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.street[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("textarea[name='street']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeeStreetErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("textarea[name='street']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.province !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeeProvinceErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.province[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("select[name='province']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeeProvinceErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("select[name='province']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.city !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeeCityErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.city[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("select[name='city']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeeCityErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("select[name='city']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.zip_code !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeeZipCodeErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.zip_code[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("input[name='zip_code']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeeZipCodeErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("input[name='zip_code']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.position !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeePositionErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.position[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("select[name='position']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeePositionErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("select[name='position']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.bank_account !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeeBankAccountErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.bank_account[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("select[name='bank_account']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeeBankAccountErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("select[name='bank_account']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.account_number !== "undefined") {
                        $("#createEmployeeModal")
                            .find("#createEmployeeBankAccountNoErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.account_number[0] +
                                    "</span>"
                            );
                        $("#createEmployeeModal")
                            .find("input[name='account_number']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#createEmployeeModal")
                            .find("#createEmployeeBankAccountNoErr")
                            .html('<span class="text-danger"></span>');
                        $("#createEmployeeModal")
                            .find("input[name='account_number']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                } else {
                    Swal.fire({
                        toast: true,
                        icon: "error",
                        title: error.responseJSON.error,
                        position: "bottom-end",
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        },
                    });
                }
                // $("#tujuanMemoPenagihanTable").DataTable().ajax.reload();
            },
        });
    },
});
$("#createEmployeeModal").on("hidden.bs.modal", function () {
    const modal = $("#createEmployeeModal");
    modal.find("#createEmployeeFirstname").val("");
    modal.find("#createEmployeeLastname").val("");
    modal.find("#createEmployeeGender").val("");
    modal.find("#createEmployeeDateOfBirth").val("");
    modal.find("#createEmployeeEmail").val("");
    modal.find("#createEmployeePhoneNo").val("");
    modal.find("#createEmployeeCitizenshipIDNo").val("");
    modal.find(`img#createEmployeeCitizenshipIDFilePreview`).attr("src", "#");
    modal.find(`img#createEmployeeCitizenshipIDFilePreview`).hide();
    modal.find("#createEmployeeCitizenshipIDFile").val("");
    modal.find("#createEmployeeStreet").val("");
    modal.find("#createEmployeeProvince").val("");
    $("#createEmployeeCity").empty();
    $("#createEmployeeCity").append(`<option value="">Select City</option>`);
    modal.find("#createEmployeeZipCode").val("");
    modal.find("#createEmployeePosition").val("");
    modal.find("#createEmployeeBankAccount").val("");
    modal.find("#createEmployeeBankAccountNo").val("");

    clearValidationView(modal);
});
$("#createEmployeePhoneNo").val(
    phoneNumberValidate($("#createEmployeePhoneNo").val())
);
$("#createEmployeePhoneNo").mask("800-0000-0000-0000");
$("#createEmployeePhoneNo").on("input", function () {
    const value = $(this).val().replace("-", "");
    if (typeof value !== "undefined" && value !== "") {
        if (value[0] == 0) {
            $(this).val(value.slice(1, value.length));
        }
    }
});
function previewCitizenshipIDFile() {
    const IDNumberFile = document.querySelector(
        "#createEmployeeCitizenshipIDFile"
    );
    const IDNumberPreview = document.querySelector(
        "#createEmployeeCitizenshipIDFilePreview"
    );

    IDNumberPreview.style.display = "block";

    if (IDNumberFile.files.length != 0) {
        const oFReader = new FileReader();
        oFReader.readAsDataURL(IDNumberFile.files[0]);
        oFReader.onload = function (oFREvent) {
            IDNumberPreview.src = oFREvent.target.result;
        };
        $(IDNumberPreview).show();
    } else {
        $(IDNumberPreview).hide();
        IDNumberPreview.src = "#";
    }
}

$("#createEmployeeProvince").on("change", function () {
    $("#createEmployeeCity").empty();
    $("#createEmployeeCity").append(`<option value="">Select City</option>`);
    const province = $(this).val();
    const url = `/get/cities/${province}`;
    if (typeof province !== "undefined" && province !== "") {
        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                $("#createEmployeeCity").empty();
                $("#createEmployeeCity").append(
                    `<option value="">Select City</option>`
                );
                const cities = response.cities;
                cities.forEach((city) => {
                    $("#createEmployeeCity").append(
                        `<option value="${city.id}">${city.name}</option>`
                    );
                });
            },
            error: function (error) {
                alert("Failed to fetch Indonesia City API!");
            },
        });
    }
});
