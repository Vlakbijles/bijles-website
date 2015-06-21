// addreview.js
//
// Handles the review modal, includes form validation, sending the review to the
// API server, displaying warnings and dynamically adding any newly created
// reviews

$(function(){

    // Char counter logic for description
    var maxLength = 500;
    var currentLength = $("#reviewDesc").val().length;
    $("#charCounter").text(currentLength + "/" + maxLength).fadeTo(0, 0.2);
    $("#reviewDesc")
        .keyup(function() {
            currentLength = $(this).val().length;
            $("#charCounter").text(currentLength + "/" + maxLength);})
        .focusin(function() {
            $("#charCounter").fadeTo(500, 0.7);})
        .focusout(function() {
            $("#charCounter").fadeTo(500, 0.2);
    });

    $("#reviewEndorsed").on("click", function(){
        $(this).parent().toggleClass("text-success text-danger");
        $(this).parent().toggleClass("stroked");
        $("#warningContent").toggleClass("hidden");
    });

    // Validation for review form
    $("#reviewForm").validate({

        // Called when form is filled in properly
        submitHandler: function(form) {
            var reviewOffer = $(form).find("#reviewOffer").val();
            var reviewDesc = $(form).find("#reviewDesc").val();
            var reviewEndorsed = $(form).find("#reviewEndorsed").is(":checked");

            $.ajax({
                url: "ajax/review.php",
                type: "POST",
                dataType: "json",
                data: {"action": "create",
                       "offer_id": reviewOffer,
                       "description": reviewDesc,
                       "endorsed": reviewEndorsed},
                statusCode: {
                    400:
                        function() {
                            alert("Er is iets misgegaan");
                        }
                }})
                .done(function(data, status, xhr) {
                    switch (xhr.status) {
                        case 200:
                            // User has already reviewed this offer
                            $("#notificationContent").load("ajax/notification.php",
                                                           {"type": "warning",
                                                            "message": "Je hebt deze gebruiker/bijles combinatie al eens beoordeeld"});
                            break;
                        case 201:
                            // Review successfully created, update page
                            $("#notificationContent").load("ajax/notification.php",
                                                           {"type": "success",
                                                            "message": "Bedankt voor je beoordeling"});
                            // TODO update page
                            break;
                        default: ;
                    }
                    $("#reviewModal").modal("toggle");
                });
        },

        rules: {
            "reviewOffer": {
                required: true,
            },
            "reviewDesc": {
                required: false,
                maxlength: 500,
            },
            "reviewEndorsed": {
                required: false,
            },
        },

        // Empty error messages, bootstrap indicators used instead
        messages: { "reviewOffer": {required: ""},
                    "reviewDesc": {required: "", maxlength: ""},
                    "reviewEndorsed": {required: ""} }

    });

});

