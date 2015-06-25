// contactuser.js
//
// Send contact request to API server

// Dependencies (must at some point be included in html):
// -

$(function(){

    // Validation for contact form
    $("#contactForm").validate({

        // Called when form is filled in properly
        submitHandler: function(form) {
            var contactOffer = $(form).find("#contactOffer").val();
            var contactMessage = $(form).find("#contactMessage").val();

            $.ajax({
                url: "/ajax/contactuser.php",
                type: "POST",
                dataType: "json",
                data: {"offer_id": contactOffer,
                       "message": contactMessage},
                statusCode: {
                    400:
                        function() {
                            $("#notificationContent").load("/ajax/notification.php",
                                                           {"type": "warning",
                                                            "message": "Er is iets misgegaan bij het contacteren"});
                        }
                }})
                .done(function(data, status, xhr) {
                    switch (xhr.status) {
                        case 200:
                            // User has already reviewed this offer
                            $("#notificationContent").load("/ajax/notification.php",
                                                           {"type": "success",
                                                            "message": "Je bericht is verzonden"});
                            break;
                        default: ;
                    }
                });
            $("#contactModal").modal("toggle");
        },

        rules: {
            "contactOffer": {
                required: true,
            },
            "contactMessage": {
                required: true,
                minlength: 10,
                maxlength: 1000,
            },
        },

        // Empty error messages, bootstrap indicators used instead
        messages: { "contactOffer": {required: ""},
                    "contactMessage": {required: "", minlength: "", maxlength: ""} }

    });


});
