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
