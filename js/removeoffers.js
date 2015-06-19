// removeoffers.js
//
// Send ajax request to API server for removing/deactivating a user's offer,
// dynamically removes the offer from the profile page and decrements the
// shown offer count

$(function(){

    $(".deleteOffer").on("click", function(e){
        e.preventDefault();
        if(confirm($(this).attr("name") + " verwijderen uit je vakkenlijst?")){
            var offerId = $(this).attr("value");
            $.ajax({
                url: "ajax/offer.php",
                type: "POST",
                data: {"action": "delete", "offer_id": offerId}})
                .done(function(data, status) {
                    if(data == "ok") {
                        $("#offerRow_" + offerId).remove();
                        $("#numOffers").text(parseInt($("#numOffers").text()) - 1);
                    } else if (data == "error") {
                        alert("Error");
                    }
                });
         }
    });

});
