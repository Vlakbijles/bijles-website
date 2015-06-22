// editprofile.js
//
// Handles the modal for editing a user's profile, validates new email and
// postal with API server to make sure the email address is not already in
// use and the postal code is valid

$(function(){

    // Char counter logic for description
    var maxLength = 1000;
    var currentLength = $("#editDesc").val().length;
    $("#charCounter").text(currentLength + "/" + maxLength).fadeTo(0, 0.2);
    $("#editDesc")
        .keyup(function() {
            currentLength = $(this).val().length;
            $("#charCounter").text(currentLength + "/" + maxLength);})
        .focusin(function() {
            $("#charCounter").fadeTo(1000, 0.7);})
        .focusout(function() {
            $("#charCounter").fadeTo(1000, 0.2);
    });

    // Postal code validator
    $.validator.addMethod("postalcode", function(value, element) {
        return this.optional(element) || /^[0-9]{4}[A-Za-z]{2}/.test(value);
    });

    // Use bootstrap classes for indicating errors
    $.validator.setDefaults({
        errorElement: "span",
        errorClass: "glyphicon glyphicon-remove form-control-feedback",
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        highlight: function(element) {
            $(element).closest(".form-group").addClass("has-error");
        },

        unhighlight: function(element) {
            $(element).closest(".form-group").removeClass("has-error");
        },
    });

    // Validation for profile editing form
    $("#editProfileForm").validate({

        // Called when form is filled in properly
        submitHandler: function(form) {
            var newEmail = $(form).find("#editEmail").val();
            var newPostalCode = $(form).find("#editPostalCode").val();
            var newDesc = $(form).find("#editDesc").val();

            $.ajax({
                url: "ajax/profile.php",
                type: "POST",
                dataType: "json",
                data: {"action": "edit",
                       "email": newEmail,
                       "postal_code": newPostalCode,
                       "description": newDesc},
                statusCode: {
                    // 400 indicates the email address is already in use, the
                    // postal code does not exist or that the max description
                    // length is exceeded
                    400:
                        function() {
                            alert("Er is iets misgegaan:\n" +
                                  "\nHet ingevulde emailadres kan al in gebruik zijn" +
                                  "\nIs de ingevoerde postcode een bestaande postcode? " +
                                  "\nBevat je beschrijving niet meer dan " + maxLength + " karakters?");
                        }
                }})
                .done(function(data, status, xhr) {
                    switch (xhr.status) {
                        case 200:
                            // Update page with updated profile returned from API
                            $("#userLocation").text(data["meta.city"]);
                            $("#userDescription").text(data["meta.description"]);
                            $("#editEmail").val(data["email"]);
                            $("#editPostalCode").val(data["meta.postal_code"]);
                            $("#editDesc").val(data["meta.description"]);
                            $("#editProfileModal").modal("toggle");
                            $("#notificationContent").load("ajax/notification.php",
                                                           {"type": "success",
                                                            "message": "Je profiel is aangepast"});
                            break;
                        default: ;
                    }
                });
        },

        rules: {
            "editEmail": {
                required: true,
                email: true,
                remote: {
                    url: "ajax/verify.php",
                    type: "GET",
                    // Verify email is not already in use via API
                    data: {
                        "verify_type": "email",
                        "verify_data": function() {
                            return $("#editEmail").val();
                        }
                    }
                }
            },
            "editPostalCode": {
                required: true,
                postalcode: true,
                remote: {
                    url: "ajax/verify.php",
                    type: "GET",
                    // Verify postal code exists via API
                    data: {
                        "verify_type": "postal_code",
                        "verify_data": function() {
                            return $("#editPostalCode").val();
                        }
                    }
                }
            },
            "editDesc": {
                maxlength: 1000,
            },
        },

        // Empty error messages, bootstrap indicators used instead
        messages: { "editEmail": {required: "", email: "", remote: ""},
                    "editPostalCode": {required: "", postalcode: "", remote: ""},
                    "editDesc": {maxlength: ""} }

    });

});

