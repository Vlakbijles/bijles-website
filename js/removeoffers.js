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
        if(confirm($(this).attr("name") + " verwijderen uit je vakkenlijst?")){
            var offerId = $(this).attr("value");
            $.ajax({
                url: "ajax/offer.php",
                type: "POST",
                data: {"action": "delete",
                       "offer_id": offerId},
                statusCode: {
                    // 400 indicated the API server was unable to remove the
                    // offer
                    400:
                        function() {
                            alert("Er is iets misgegaan bij het verwijderen " +
                                   "van dit vak, wellicht is het al verwijderd?");
                        }
                }})
                .done(function(data) {
                    if(data) {
                        $("#offerRow_" + offerId).remove();
                        $("#numOffers").text(parseInt($("#numOffers").text()) - 1);
                    }
                });
         }
    });

});
