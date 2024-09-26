$(document).ready(function () {
    saveData();
});

function saveData() {
    $("#form").on("submit", function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: formData,
            success: function (response) {
                if (response.status === 201) {
                    toastr.success(response.success);
                    $("#form")[0].reset(); // Reset the form
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, messages) {
                        toastr.error(messages[0]); // Show first error message
                    });
                } else {
                    toastr.error("Failed to save data.");
                }
            },
        });
    });
}
