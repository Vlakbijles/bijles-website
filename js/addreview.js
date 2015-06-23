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
                            //TODO handle review with no content
                            //TODO major refactoring

                            // Review successfully created, add new review and
                            // possible endorsment head to page
                            var userId = data["author.id"];
                            var description = data["description"];
                            var subjectName = data["offer.subject.name"];
                            var levelName = data["offer.level.name"];
                            var photoSrc = data["author.meta.photo_id"];
                            var name = data["author.meta.name"];
                            var surname = data["author.meta.surname"];
                            var endorsed = data["endorsed"];

                            $("#notificationContent").load("/ajax/notification.php",
                                                           {"type": "success",
                                                            "message": "Bedankt voor je beoordeling"});

                            // Clone review template
                            if (allignLeft) {
                                $("#reviewLeftTemplate").clone().prop({id: "newReview"}).removeClass("hidden").prependTo($("#reviewContainer"));
                            } else {
                                $("#reviewRightTemplate").clone().prop({id: "newReview"}).removeClass("hidden").prependTo($("#reviewContainer"));
                            }
                            // Toggle allignment for next review
                            allignLeft = !allignLeft;

                            // Fill review template with review data as returned from API
                            $("#newReview").find(".reviewDescription").text(description);
                            $("#newReview").find(".reviewDate").text("Zojuist");
                            $("#newReview").find(".reviewSubject").text(subjectName);
                            $("#newReview").find(".reviewLevel").text(levelName);
                            $("#newReview").find(".reviewAuthorPhoto").attr({"src": photoSrc,
                                                                             "alt": name + " " + surname});
                            $("#newReview").find(".reviewAuthorLink").attr("href", "index.php?page=profile&id=" + userId);
                            $("#newReview").find(".reviewAuthor").text(name + " " + surname);

                            if (endorsed) {

                                // Increment endorsment counter
                                if (parseInt($("#endorsmentCounter-lg").text()) == 0) $("#endorsmentIndicator").removeClass("hidden");
                                $("#endorsmentCounter-lg").text(parseInt($("#endorsmentCounter-lg").text()) + 1);
                                $("#endorsmentCounter-sm").text(parseInt($("#endorsmentCounter-sm").text()) + 1);
                                $("#endorsmentCounter-md").text(parseInt($("#endorsmentCounter-md").text()) + 1);

                                // Update endorsers tab with user posting review if not already in the list
                                if ($("#endorsmentHead_" + userId).length == 0) {

                                    // Enable the tab if there were no endorsers before
                                    if (parseInt($("#numEndorsers").text()) == 0) {
                                        $("#tabEndorsersBtn").removeClass("disabled");
                                        $("#tabEndorsersLink").attr({"data-toggle": "tab", "href": "#endorsments"});
                                    }
                                    $("#numEndorsers").text(parseInt($("#numEndorsers").text()) + 1);

                                    // Add endorser to tab
                                    $(".endorsmentHeadTemplate").clone().prop({id: "endorsmentHead_" + userId}).removeClass("hidden").prependTo($("#endorsmentsHeads"));
                                    $("#endorsmentHead_" + userId).find(".endorsmentHeadLink").attr("href", "index.php?page=profile&id=" + userId);
                                    $("#endorsmentHead_" + userId).find(".endorsmentHeadPhoto").attr({"src": photoSrc, "alt": name + " " + surname});
                                }
                            } else {

                                // Remove endorsment indicator from review
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

