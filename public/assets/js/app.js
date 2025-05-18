jQuery.validator.addMethod(
    "numericdashes",
    function (value, element) {
        if (/^[0-9\-]+$/i.test(value)) {
            return true;
        } else {
            return false;
        }
    },
    "Numbers and dashes only"
);
$.ajax({
    url: "/get/provinces",
    method: "GET",
    success: function (response) {
        const provinces = response.provinces;

        $("#createEmployeeProvince").empty();
        $("#createEmployeeProvince").append(
            `<option value="">Select Province</option>`
        );

        $("#updateEmployeeProvince").empty();
        $("#updateEmployeeProvince").append(
            `<option value="">Select Province</option>`
        );
        provinces.forEach((province) => {
            $("#createEmployeeProvince").append(
                `<option value="${province.id}">${province.name}</option>`
            );
            $("#updateEmployeeProvince").append(
                `<option value="${province.id}">${province.name}</option>`
            );
        });
    },
    error: function (error) {
        alert("Failed to fetch Indonesia Province API!");
    },
});
$("input[data-type='number']").on("input", function () {
    if (/^[0-9]+$/.test($(this).val())) {
        $(this).val($(this).val().replace(/,/g, ""));
    } else {
        $(this).val(
            $(this)
                .val()
                .substring(0, $(this).val().length - 1)
        );
    }
});

function clearValidationView(modal) {
    modal
        .find("input[name='firstname']")
        .removeClass("is-invalid")
        .removeClass("is-valid");
    modal
        .find("input[name='lastname']")
        .removeClass("is-invalid")
        .removeClass("is-valid");
    modal
        .find("select[name='gender']")
        .removeClass("is-invalid")
        .removeClass("is-valid");
    modal
        .find("input[name='date_of_birth']")
        .removeClass("is-invalid")
        .removeClass("is-valid");
    modal
        .find("input[name='email']")
        .removeClass("is-invalid")
        .removeClass("is-valid");
    modal
        .find("input[name='phone']")
        .removeClass("is-invalid")
        .removeClass("is-valid");
    modal
        .find("input[name='citizenship_id_no']")
        .removeClass("is-invalid")
        .removeClass("is-valid");
    modal
        .find("input[name='citizenship_id_file']")
        .removeClass("is-invalid")
        .removeClass("is-valid");
    modal
        .find("textarea[name='street']")
        .removeClass("is-invalid")
        .removeClass("is-valid");
    modal
        .find("select[name='province']")
        .removeClass("is-invalid")
        .removeClass("is-valid");
    modal
        .find("select[name='city']")
        .removeClass("is-invalid")
        .removeClass("is-valid");
    modal
        .find("input[name='zip_code']")
        .removeClass("is-invalid")
        .removeClass("is-valid");
    modal
        .find("select[name='position']")
        .removeClass("is-invalid")
        .removeClass("is-valid");
    modal
        .find("select[name='bank_account']")
        .removeClass("is-invalid")
        .removeClass("is-valid");

    modal
        .find("input[name='account_number']")
        .removeClass("is-invalid")
        .removeClass("is-valid");
}
function phoneNumberValidate(phone) {
    const value = phone.replace("-", "");
    if (typeof value !== "undefined" && value !== "") {
        if (value[0] == 0) {
            return value.slice(1, value.length);
        } else {
            return value;
        }
    }
}
