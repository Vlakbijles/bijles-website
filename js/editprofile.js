// editprofile.js
//
// Handles the modal for editing a user's profile

$(function(){

    // Fade in/out edit button
    $("#profile").hover(
        function() { $(this).find("#editProfileBtn").fadeTo(500, 1); },
        function() { $(this).find("#editProfileBtn").fadeTo(0, 0); }
    );

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
                       "zipcode": newPostalCode,
                       "description": newDesc},
                statusCode: {
                    // 400 indicates the email address is already in use, the
                    // zipcode does not exist or that the max description
                    // length is exceeded
                    400:
                        function() {
                            alert("Er is iets misgegaan:\n" +
                                  "\nHet ingevulde emailadres kan al in gebruik zijn" +
                                  "\nIs de ingevoerde postcode een bestaande postcode? " +
                                  "\nBevat je beschrijving niet meer dan " + maxLength + " karakters?");
                        }
                }})
                .done(function(data) {
                    if (data) {
                        // Update page with updated profile returned from API
                        $("#userLocation").text(data["meta.city"]);
                        $("#userDescription").text(data["meta.description"]);
                        $("#editEmail").val(data["email"]);
                        $("#editPostalCode").val(data["meta.zipcode"]);
                        $("#editDesc").val(data["meta.description"]);
                        $("#editProfileModal").modal("toggle");
                    }
                });
        },

        rules: {
            "editEmail": {
                required: true,
                email: true
            },
            "editPostalCode": {
                required: true,
                postalcode: true
            },
            "editDesc": {
                maxlength: 1000,
            },
        },

        // Empty error messages, bootstrap indicators used instead
        messages: { "editEmail": {required: "", email: ""},
                    "editPostalCode": {required: "", postalcode: ""},
                    "editDesc": {maxlength: ""} }

    });

});

