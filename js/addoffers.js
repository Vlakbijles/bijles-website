// addoffers.js
//
// Script for the add offers modal, handles possible extra rows and their
// autocomplete, handles ajax request to submit the offers, dynamically
// updates profile page when offers are succesfully created

$(function(){

    var numOffers = 1;

    // Required for adding autocomplete to possible extra offer rows,
    // appropriate hidden fields need to be set
    function enableAutoComplete(x) {
        return $("#subject_name" + x).autocomplete({
                    source: subjects,
                    select: function (event, ui) {
                        event.preventDefault();
                        $(this).val(ui.item.label);
                        $("#subject_id" + x).val(ui.item.value);
                    },
                    focus: function (event, ui) {
                        event.preventDefault();
                        $(this).val(ui.item.label);
                        $("#subject_id" + x).val(ui.item.value);
                    },
                    change: function (event, ui) {
                        if(!ui.item){
                            $(this).val("");
                            $("#subject_id" + x).val("");
                        }
                    },
                });
    };

    enableAutoComplete(numOffers); // Enable autocomplete on initial row

    // Clone extra row, set id's and enable autocomplete
    $("#extraOfferBtn").on("click", function(e){
        numOffers = numOffers + 1;
        $("#extraOfferRow").clone().prop({id: "addOfferRow_" + numOffers}).appendTo("#addOffers");
        $("#addOfferRow_" + numOffers).removeClass("hidden");
        $("#addOfferRow_" + numOffers).find("#subject_name").prop({id: "subject_name" + numOffers});
        $("#addOfferRow_" + numOffers).find("#subject_id").prop({id: "subject_id" + numOffers});
        $("#addOfferRow_" + numOffers).find("#level_id").prop({id: "level_id" + numOffers});
        enableAutoComplete(numOffers);
    });

    $(document).on("click", "button.removeOfferBtn", function(e) {
        $(this).parent().parent().remove();
    });

    $("#submitOfferBtn").on("click", function(e){

        for(i = 1; i <= numOffers; i++) {

            console.log(i + ": " +  $("#addOfferRow_" + i).children("input.subjectId").val()  );

            // TODO ajax request, on success add offers to offers table

        }

        // $("#addOffersModal").modal("toggle");

    });

});
