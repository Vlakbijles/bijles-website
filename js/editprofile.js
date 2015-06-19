// editprofile.js
//
// bla

$(function(){

    $("#profile").hover(
        function() { $(this).find("#editProfileBtn").fadeTo(500, 1); },
        function() { $(this).find("#editProfileBtn").fadeTo(0, 0); }
    );

    // $(document).on("click", "button.deleteOfferBtn", function(e){
    //     e.preventDefault();
    //     if(confirm($(this).attr("name") + " verwijderen uit je vakkenlijst?")){
    //         var offerId = $(this).attr("value");
    //         $.ajax({
    //             url: "ajax/offer.php",
    //             type: "POST",
    //             data: {"action": "delete", "offer_id": offerId}})
    //             .done(function(data, status) {
    //                 if(data == "ok") {
    //                     $("#offerRow_" + offerId).remove();
    //                     $("#numOffers").text(parseInt($("#numOffers").text()) - 1);
    //                 }
    //             });
    //      }
    // });

});

