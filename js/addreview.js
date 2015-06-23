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

    // Show warning when user is to explicitely not endorse an offer
    $("#reviewEndorsed").on("click", function(){
        $(this).parent().toggleClass("text-success text-danger");
        $(this).parent().toggleClass("stroked");
        $("#warningContent").toggleClass("hidden");
    });

    // Keep track of which alligment to use for dynamically adding review, for
    // the case a user leaves more than one review
    var allignLeft = true;
    if (parseInt($("#reviewCounter").text()) == 0) allignLeft = false;

    // Validation for review form
    $("#reviewForm").validate({

        // Called when form is filled in properly
        submitHandler: function(form) {
            var reviewOffer = $(form).find("#reviewOffer").val();
            var reviewDesc = $(form).find("#reviewDesc").val();
            var reviewEndorsed = $(form).find("#reviewEndorsed").is(":checked");

            $.ajax({
                url: "/ajax/review.php",
                type: "POST",
                dataType: "json",
                data: {"action": "create",
                       "offer_id": reviewOffer,
                       "description": reviewDesc,
                       "endorsed": reviewEndorsed},
                statusCode: {
                    400:
                        function() {
                            $("#notificationContent").load("/ajax/notification.php",
                                                           {"type": "warning",
                                                            "message": "Er is iets misgegaan, mogelijke oorzaken zijn dat de bijles " +
                                                                       "aanbieding niet bestaat, je jezelf probeert te recenseren " +
                                                                       "of je de maximale lengte van de beschrijving hebt overschreden"});
                        }
                }})
                .done(function(data, status, xhr) {
                    switch (xhr.status) {
                        case 200:
                            // User has already reviewed this offer
                            $("#notificationContent").load("/ajax/notification.php",
                                                           {"type": "warning",
                                                            "message": "Je hebt deze gebruiker/bijles combinatie al eens beoordeeld"});
                            break;
                        case 201:
                            // Review successfully created, update page
                            $("#notificationContent").load("/ajax/notification.php",
                                                           {"type": "success",
                                                            "message": "Bedankt voor je beoordeling"});

                            // Update page
                            if (allignLeft) {
                                $("#reviewLeftTemplate").clone().prop({id: "newReview"}).prependTo($("#reviewContainer"));
                            } else {
                                $("#reviewRightTemplate").clone().prop({id: "newReview"}).prependTo($("#reviewContainer"));
                            }
                            // Toggle allignment for next review
                            allignLeft = !allignLeft;

                            $("#newReview").removeClass("hidden");
                            $("#newReview").find(".reviewDescription").text(data["description"]);
                            $("#newReview").find(".reviewDate").text("Zojuist");
                            $("#newReview").find(".reviewSubject").text(data["offer.subject.name"]);
                            $("#newReview").find(".reviewLevel").text(data["offer.level.name"]);
                            $("#newReview").find(".reviewAuthorPhoto").attr({"src": data["author.meta.photo_id"],
                                                                             "alt": data["author.meta.name"] + " " + data["author.meta.surname"]});
                            $("#newReview").find(".reviewAuthorLink").attr("href", "index.php?page=profile&id=" + data["author.id"]);
                            $("#newReview").find(".reviewAuthor").text(data["author.meta.name"] + " " + data["author.meta.surname"]);

                            // Show endorsment in review, increment endorsment counters
                            if (data["endorsed"]) {
                                if (parseInt($("#endorsmentCounter").text()) == 0) $("#endorsmentIndicator").removeClass("hidden");
                                $("#endorsmentCounter").text(parseInt($("#endorsmentCounter").text()) + 1);
                            } else {
                                $("#newReview").find(".reviewEndorsed").remove();
                            }

                            // Increment review counter
                            $("#reviewCounter").text(parseInt($("#reviewCounter").text()) + 1);

                            // Clear ID so another review can be added
                            $("#newReview").prop({id: ""});

                            break;
                        default: ;
                    }
                });
            $("#reviewModal").modal("toggle");
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

