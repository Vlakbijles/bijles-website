// editprofile.js
//
// bla

$(function(){

    // Fade edit profile button
    $("#profile").hover(
        function() { $(this).find("#editProfileBtn").fadeTo(500, 1); },
        function() { $(this).find("#editProfileBtn").fadeTo(0, 0); }
    );

    // Char counter logic
    var maxLength = 1000;
    var currentLength = $("#editDesc").val().length;
    $("#charCounter").text(currentLength + "/" + maxLength).fadeTo(0, 0.2);
    $("#editDesc")
        .keyup(function() {
            currentLength = $(this).val().length;
            $("#charCounter").text(currentLength + "/" + maxLength);})
        .focusin(function() {
            $("#charCounter").fadeTo(1000, 0.7);})
        .focusout(function() {
            $("#charCounter").fadeTo(1000, 0.2);
    });

    // Postal code validator
    $.validator.addMethod("postalcode", function(value, element) {
        return this.optional(element) || /^[0-9]{4}[A-Za-z]{2}/.test(value);
    });

    // Use bootstrap classes for indicating errors
    $.validator.setDefaults({
        errorElement: "span",
        errorClass: "glyphicon glyphicon-remove form-control-feedback",
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        highlight: function(element) {
            $(element).closest(".form-group").addClass("has-error");
        },

        unhighlight: function(element) {
            $(element).closest(".form-group").removeClass("has-error");
        },
    });

    // Actual validation
    $("#editProfileForm").validate({

        // submitHandler: function(form) { alert("joe"); },

        rules: {
            "editEmail": {
                required: true,
                email: true
            },
            "editPostalCode": {
                required: true,
                postalcode: true
            },
            "editDesc": {
                maxlength: 1000,
            },
        },

        // Empty error messages, bootstrap indicators used instead
        messages: { "editEmail": {required: "", email: ""},
                    "editPostalCode": {required: "", postalcode: ""},
                    "editDesc": {maxlength: ""} }

    });


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

