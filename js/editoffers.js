$(function(){

    var levels = (function () {
        var formatted = [];
        $.ajax({
            async: true,
            url: "ajaxutils/subject.php?action=all",
            dataType: "json",
            success: function (data) {
                if(data) {
                    return data;
                }
            }
        });
    })();

    $(".deleteOffer").on("click", function(e){
        e.preventDefault();
        if(confirm($(this).attr("name") + " verwijderen uit je vakkenlijst?")){
            var offerID = $(this).attr("value");
            $.ajax({
                url: "ajaxutils/offer.php",
                type: "POST",
                data: {"action": "delete", "offer_id": offerID},
                success: function(data, status) {
                    if(data == "ok") {
                        $("#offer" + offerID).remove();
                        $("#numOffers").text(parseInt($("#numOffers").text()) - 1);
                    } else if (data == "error") {
                        alert("Error");
                    }
                }
            });
        }
    });

});
