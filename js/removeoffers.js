// removeoffers.js
//
// Send ajax request to API server for removing/deactivating a user's offer,
// dynamically removes the offer from the profile page and decrements the
// shown offer count. Contains handler for fading of offer delete buttons.

$(function(){

    // Fade delete offer buttons
    $(document)
        .on("mouseenter", ".offerRow", function() {
            $(this).find(".deleteOfferBtn").stop(true, true).fadeTo(300, 1);})
        .on("mouseleave", ".offerRow", function() {
             $(this).find(".deleteOfferBtn").stop(true, true).fadeTo(0, 0);
    });

    // Delete offer button handler
    $(document).on("click", "button.deleteOfferBtn", function(e){
        e.preventDefault();
        var subjectName = $(this).attr("name");
        if(confirm(subjectName + " verwijderen uit je vakkenlijst?")){
            var offerId = $(this).attr("value");
            $.ajax({
                url: "ajax/offer.php",
                type: "POST",
                data: {"action": "delete",
                       "offer_id": offerId},
                statusCode: {
                    // Unable to remove offer
                    400:
                        function() {
                            $("#notificationContent").load("ajax/notification.php",
                                {"type": "warning",
                                 "message": "Er is iets misgegaan bij het " +
                                            "verwijderen van " + subjectName +
                                            ", wellicht is deze al verwijderd?"});
                        }
                }})
                .done(function(data, status, xhr) {
                    switch (xhr.status) {
                        case 200:
                            // Offer succesfully removed/deactivated
                            $("#offerRow_" + offerId).remove();
                            $("#numOffers").text(parseInt($("#numOffers").text()) - 1);
                            break;
                        default: ;
                    }
                });
         }
    });

});
