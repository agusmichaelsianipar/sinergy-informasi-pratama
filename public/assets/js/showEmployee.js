$("#showImageModal")
    .on("shown.bs.modal", function (event) {
        $("#citizenshipIdentityImagePreview").attr(
            "src",
            $(event.relatedTarget).data("citizenship_id_file")
        );
    })
    .on("hidden.bs.modal", function (event) {
        $("#citizenshipIdentityImagePreview").attr("src", "#");
    });

let searchParams = new URLSearchParams(window.location.search);
$("#employeesTable").DataTable({
    processing: true,
    serverSide: true,
    searching: true,
    fixedHeader: true,
    ajax: {
        type: "GET",
        contentType: "application/x-www-form-urlencoded",
        url: `/employees`,
        data: {
            position: searchParams.get("position"),
        },
    },
    columnDefs: [
        {
            className: "text-nowrap",
            targets: [0],
        },
        {
            orderable: false,
            targets: [0, 10],
        },
        {
            searchable: false,
            targets: [0],
        },
    ],
    columns: [
        {
            data: "action",
            name: "action",
        },
        {
            data: "employee_id_number",
            name: "employee_id_number",
        },
        {
            data: "name",
            name: "name",
        },
        {
            data: "date_of_birth",
            name: "date_of_birth",
        },
        {
            data: "phone",
            name: "phone",
        },
        {
            data: "email",
            name: "email",
        },
        {
            data: "province_name",
            name: "province_name",
        },
        {
            data: "city_name",
            name: "city_name",
        },
        {
            data: "street",
            name: "street",
        },
        {
            data: "zip_code",
            name: "zip_code",
        },
        {
            data: "citizenship_id",
            name: "citizenship_id",
        },
        {
            data: "position",
            name: "position",
        },
        {
            data: "bank_account",
            name: "bank_account",
        },
    ],
});
