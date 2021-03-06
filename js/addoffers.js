// addoffers.js
//
// Script for the add offers modal, handles possible extra rows and their
// autocomplete, handles ajax request to submit the offers, dynamically
// updates profile page when offers are succesfully created

// Dependencies (must at some point be included in html):
// charcounter.js
// loadlevels.js
// loadsubjects.js

$(function(){

    // Reset first row, remove any dynamically added rows
    function clearForm() {
        $("#subject_name1").val("");
        $("#subject_id1").val("");
        $("#level_id1").val(1);

        for(i = 2; i <= numOffers; i++) {
            $(document).find("#addOfferRow_" + i).remove();
        }

        numOffers = 1;
    }

    // Required for adding autocomplete to possible extra offer rows,
    // appropriate hidden fields need to be set
    function enableAutoComplete(x) {
        source = subjects;
        return $("#subject_name" + x).autocomplete({
                    source: function (request, response) {
                        var term = $.ui.autocomplete.escapeRegex(request.term)
                            , startsWithMatcher = new RegExp("^" + term, "i")
                            , startsWith = $.grep(source, function(value) {
                                return startsWithMatcher.test(value.label || value.value || value);
                            })
                            , containsMatcher = new RegExp(term, "i")
                            , contains = $.grep(source, function (value) {
                                return $.inArray(value, startsWith) < 0 &&
                                    containsMatcher.test(value.label || value.value || value);
                            });

                        response(startsWith.concat(contains));
                    },
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

    // Initialization
    var numOffers = 1;
    enableAutoComplete(numOffers); // Enable autocomplete on initial row

    // Load levels into level selector
    $("#addOffersBtn").one("click", function(){
        $.each(levels, function(index, value) {
            $(".levelSelector").append("<option value=" + value.value + ">" + value.label + "</option>");
        });
    });

    // Handler for dynamically adding extra rows
    $("#extraOfferBtn").on("click", function(){
        numOffers = numOffers + 1;
        $("#extraOfferRow").clone().prop({id: "addOfferRow_" + numOffers}).appendTo("#addOffers");
        $("#addOfferRow_" + numOffers).removeClass("hidden");
        $("#addOfferRow_" + numOffers).find("#subject_name").prop({id: "subject_name" + numOffers});
        $("#addOfferRow_" + numOffers).find("#subject_id").prop({id: "subject_id" + numOffers});
        $("#addOfferRow_" + numOffers).find("#level_id").prop({id: "level_id" + numOffers});
        enableAutoComplete(numOffers);
    });

    // Enable remove buttons on extra rows
    $(document).on("click", "button.removeOfferBtn", function() {
        $(this).parent().parent().remove();
    });

    // Submit new offers to API server
    $("#submitOfferBtn").on("click", function(){
        for(i = 1; i <= numOffers; i++) {
            var subjectId = $("#subject_id" + i).val();
            var levelId = $("#level_id" + i).val();
            if (subjectId && levelId) {
                $.ajax({
                    url: "/ajax/offer.php",
                    type: "POST",
                    dataType: "json",
                    data: {"action": "create",
                           "subject_id": subjectId,
                           "level_id": levelId},
                    statusCode: {
                        400:
                            // 400 indicated the API could not create the offer
                            function() {
                                alert("Er is iets misgegaan bij het toevoegen" +
                                      " van een vak");
                            }
                    }})
                    .done(function(data, status, xhr) {
                        switch (xhr.status) {
                            case 200:
                                // Offer already exists, do nothing
                                break;
                            case 201:
                                // Offer created, add to offer table
                                $("#offerRow").clone().prop({id: "offerRow_" + data["id"]}).prependTo($("#offerTable tbody"));
                                $("#offerRow_" + data["id"]).removeClass("hidden");
                                $("#offerRow_" + data["id"]).find(".subjectName").text(data["subject.name"]);
                                $("#offerRow_" + data["id"]).find(".levelName").text(data["level.name"]);
                                $("#numOffers").text(parseInt($("#numOffers").text()) + 1);
                                $("#offerRow_" + data["id"]).find(".deleteOfferBtn").attr({value: data["id"], name: data["subject.name"]});
                                break;
                            default: ;
                        }
                    });
            }
        }
        clearForm();
        $("#addOffersModal").modal("toggle");
    });

});
