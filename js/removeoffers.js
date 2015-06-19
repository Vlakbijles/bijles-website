$(function(){

    $(".deleteOffer").on("click", function(e){
        e.preventDefault();
        if(confirm($(this).attr("name") + " verwijderen uit je vakkenlijst?")){
            var offerID = $(this).attr("value");
            $.ajax({
                url: "ajax/offer.php",
                type: "POST",
                data: {"action": "delete", "offer_id": offerID}})
                .done(function(data, status) {
                    if(data == "ok") {
                        $("#offer" + offerID).remove();
                        $("#numOffers").text(parseInt($("#numOffers").text()) - 1);
                    } else if (data == "error") {
                        alert("Error");
                    }
                });
         }
    });

    // levels = (function() {
    //     $.ajax({
    //         url: "ajax/level.php?action=all",
    //         dataType: "json"})
    //         .done(function(data) {
    //             if(data) {
    //                 $.each(data, function(index, value) {
    //                     $(".levelSelector").append("<option value=" + value.id + ">" + value.name + "</option>");
    //                 });
    //                 return data;
    //             }
    //         });
    // })();

});
