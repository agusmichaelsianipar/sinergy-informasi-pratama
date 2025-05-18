$("#updateEmployeeModal")
    .on("shown.bs.modal", function (event) {
        const modal = $("#updateEmployeeModal");
        const employee = $(event.relatedTarget).data("employee");
        const url = $(event.relatedTarget).data("url");
        const firstname = $(event.relatedTarget).data("firstname");
        const lastname = $(event.relatedTarget).data("lastname");
        const gender = $(event.relatedTarget).data("gender");
        const date_of_birth = $(event.relatedTarget).data("date_of_birth");
        const email = $(event.relatedTarget).data("email");
        const phone = $(event.relatedTarget).data("phone");
        const citizenship_id_no = $(event.relatedTarget).data(
            "citizenship_id_no"
        );
        const citizenship_id_file = $(event.relatedTarget).data(
            "citizenship_id_file"
        );
        const street = $(event.relatedTarget).data("street");
        const province = $(event.relatedTarget).data("province");
        const city = $(event.relatedTarget).data("city");
        const zip_code = $(event.relatedTarget).data("zip_code");
        const position = $(event.relatedTarget).data("position");
        const bank_account = $(event.relatedTarget).data("bank_account");
        const account_number = $(event.relatedTarget).data("account_number");

        modal.find("form#updateEmployeeForm").attr("action", url);
        modal.find("#updateEmployeeID").val(employee);
        modal.find("#updateEmployeeFirstname").val(firstname);
        modal.find("#updateEmployeeLastname").val(lastname);
        modal.find("#updateEmployeeGender").val(gender);
        modal.find("#updateEmployeeDateOfBirth").val(date_of_birth);
        modal.find("#updateEmployeeEmail").val(email);
        modal.find("#updateEmployeePhoneNo").val(phone);
        modal.find("#updateEmployeeCitizenshipIDNo").val(citizenship_id_no);

        if (
            typeof citizenship_id_file !== "undefined" &&
            citizenship_id_file !== ""
        ) {
            modal.find(`img#updateEmployeeCitizenshipIDFilePreview`).show();
            modal
                .find(`img#updateEmployeeCitizenshipIDFilePreview`)
                .attr("src", citizenship_id_file);
            modal
                .find(`label[for="updateEmployeeCitizenshipIDFile"]`)
                .html(`Citizenship ID File`);
            $("#updateEmployeeCitizenshipIDFile").removeAttr("required");
        } else {
            modal.find(`img#updateEmployeeCitizenshipIDFilePreview`).hide();
            modal
                .find(`img#updateEmployeeCitizenshipIDFilePreview`)
                .attr("src", "#");
            modal.find(`label[for="updateEmployeeCitizenshipIDFile"]`).html(
                `Citizenship ID File
                <span class="text-danger">*</span>`
            );
            $("#updateEmployeeCitizenshipIDFile").attr("required", "required");
        }
        modal.find("#updateEmployeeStreet").text(street);
        modal.find("#updateEmployeeProvince").val(province);
        fetchCityByProvince(province, city);
        modal.find("#updateEmployeeZipCode").val(zip_code);
        modal.find("#updateEmployeePosition").val(position);
        modal.find("#updateEmployeeBankAccount").val(bank_account);
        modal.find("#updateEmployeeBankAccountNo").val(account_number);
    })
    .on("hidden.bs.modal", function () {
        const modal = $("#updateEmployeeModal");
        modal.find("form#updateEmployeeForm").attr("action", "");
        modal.find("#updateEmployeeID").val("");
        modal.find("#updateEmployeeFirstname").val("");
        modal.find("#updateEmployeeLastname").val("");
        modal.find("#updateEmployeeGender").val("");
        modal.find("#updateEmployeeDateOfBirth").val("");
        modal.find("#updateEmployeeEmail").val("");
        modal.find("#updateEmployeePhoneNo").val("");
        modal.find("#updateEmployeeCitizenshipIDNo").val("");
        modal
            .find(`img#updateEmployeeCitizenshipIDFilePreview`)
            .attr("src", "#");
        modal.find(`img#updateEmployeeCitizenshipIDFilePreview`).hide();
        modal.find("#updateEmployeeStreet").text("");
        modal.find("#updateEmployeeProvince").val("");
        $("#updateEmployeeCity").empty();
        $("#updateEmployeeCity").append(
            `<option value="">Select City</option>`
        );
        modal.find("#updateEmployeeZipCode").val("");
        modal.find("#updateEmployeePosition").val("");
        modal.find("#updateEmployeeBankAccount").val("");
        modal.find("#updateEmployeeBankAccountNo").val("");

        clearValidationView(modal);
    });

function fetchCityByProvince(province, selectedCity = null) {
    $("#updateEmployeeCity").empty();
    $("#updateEmployeeCity").append(`<option value="">Select City</option>`);

    const url = `/get/cities/${province}`;
    if (typeof province !== "undefined" && province !== "") {
        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                $("#updateEmployeeCity").empty();
                $("#updateEmployeeCity").append(
                    `<option value="">Select City</option>`
                );
                const cities = response.cities;
                cities.forEach((city) => {
                    $("#updateEmployeeCity").append(
                        `<option value="${city.id}">${city.name}</option>`
                    );
                });

                if (
                    typeof selectedCity !== "undefined" &&
                    selectedCity !== ""
                ) {
                    $("#updateEmployeeCity").val(selectedCity);
                } else {
                    $("#updateEmployeeCity").val("");
                }
            },
            error: function (error) {
                alert("Failed to fetch Indonesia City API!");
            },
        });
    }
}

$("#updateEmployeeForm").validate({
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
            required: function (element) {
                return hasAttr(
                    $("#updateEmployeeCitizenshipIDFile"),
                    "required"
                );
            },
            // filesize: 2048,
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

        $("#updateEmployeeSubmitButton").prop("disabled", true);

        let formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: $("form#updateEmployeeForm").attr("action"),
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#updateEmployeeSubmitButton").prop("disabled", false);

                $("#createTujuanMemoPenagihanNamaTujuanMemo").val("");

                $("#createTujuanMemoPenagihanEmailTujuanMemo").val("");

                $("#createTujuanMemoPenagihanGroup").val("");

                $("#updateEmployeeModal").modal("hide");

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
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeFirstnameErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.firstname[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("input[name='firstname']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeFirstnameErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
                            .find("input[name='firstname']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.lastname !== "undefined") {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeLastnameErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.lastname[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("input[name='lastname']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeLastnameErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
                            .find("input[name='lastname']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.gender !== "undefined") {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeGenderErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.gender[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("select[name='gender']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeGenderErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
                            .find("select[name='gender']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.date_of_birth !== "undefined") {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeDateOfBirthErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.date_of_birth[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("input[name='date_of_birth']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeDateOfBirthErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
                            .find("input[name='date_of_birth']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.email !== "undefined") {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeEmailErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.email[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("input[name='email']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeEmailErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
                            .find("input[name='email']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.phone !== "undefined") {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeePhoneNoErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.phone[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("input[name='phone']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeePhoneNoErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
                            .find("input[name='phone']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.citizenship_id_no !== "undefined") {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeCitizenshipIDNoErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.citizenship_id_no[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("input[name='citizenship_id_no']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeCitizenshipIDNoErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
                            .find("input[name='citizenship_id_no']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.citizenship_id_file !== "undefined") {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeCitizenshipIDFileErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.citizenship_id_file[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("input[name='citizenship_id_file']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeCitizenshipIDFileErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
                            .find("input[name='citizenship_id_file']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.street !== "undefined") {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeStreetErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.street[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("textarea[name='street']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeStreetErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
                            .find("textarea[name='street']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.province !== "undefined") {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeProvinceErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.province[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("select[name='province']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeProvinceErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
                            .find("select[name='province']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.city !== "undefined") {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeCityErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.city[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("select[name='city']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeCityErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
                            .find("select[name='city']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.zip_code !== "undefined") {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeZipCodeErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.zip_code[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("input[name='zip_code']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeZipCodeErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
                            .find("input[name='zip_code']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.position !== "undefined") {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeePositionErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.position[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("select[name='position']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeePositionErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
                            .find("select[name='position']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.bank_account !== "undefined") {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeBankAccountErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.bank_account[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("select[name='bank_account']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeBankAccountErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
                            .find("select[name='bank_account']")
                            .removeClass("is-invalid")
                            .addClass("is-valid");
                    }
                    if (typeof err.account_number !== "undefined") {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeBankAccountNoErr")
                            .html(
                                '<span class="text-danger">' +
                                    err.account_number[0] +
                                    "</span>"
                            );
                        $("#updateEmployeeModal")
                            .find("input[name='account_number']")
                            .removeClass("is-valid")
                            .addClass("is-invalid");
                    } else {
                        $("#updateEmployeeModal")
                            .find("#updateEmployeeBankAccountNoErr")
                            .html('<span class="text-danger"></span>');
                        $("#updateEmployeeModal")
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
            },
        });
    },
});

$("#updateEmployeePhoneNo").val(
    phoneNumberValidate($("#updateEmployeePhoneNo").val())
);
$("#updateEmployeePhoneNo").mask("800-0000-0000-0000");

$("#updateEmployeePhoneNo").on("input", function () {
    const value = $(this).val().replace("-", "");
    if (typeof value !== "undefined" && value !== "") {
        if (value[0] == 0) {
            $(this).val(value.slice(1, value.length));
        }
    }
});
// $("#updateEmployeePhoneNo").on("input", function () {
//     if (/^[0-9]+$/.test($(this).val())) {
//         $(this).val($(this).val().replace(/,/g, ""));
//     } else {
//         $(this).val(
//             $(this)
//                 .val()
//                 .substring(0, $(this).val().length - 1)
//         );
//     }
// });
function previewCitizenshipIDFile() {
    const IDNumberFile = document.querySelector(
        "#updateEmployeeCitizenshipIDFile"
    );
    const IDNumberPreview = document.querySelector(
        "#updateEmployeeCitizenshipIDFilePreview"
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
function hasAttr(el, attr) {
    if (
        typeof el === "object" &&
        el !== null &&
        "getAttribute" in el &&
        el.hasAttribute(attr)
    )
        return true;
    else return false;
}

$("#updateEmployeeProvince").on("change", function () {
    $("#updateEmployeeCity").empty();
    $("#updateEmployeeCity").append(`<option value="">Select City</option>`);
    const province = $(this).val();
    const url = `/get/cities/${province}`;
    if (typeof province !== "undefined" && province !== "") {
        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                $("#updateEmployeeCity").empty();
                $("#updateEmployeeCity").append(
                    `<option value="">Select City</option>`
                );
                const cities = response.cities;
                cities.forEach((city) => {
                    $("#updateEmployeeCity").append(
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
