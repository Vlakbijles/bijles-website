// validator_search.js
//
// Validator for search form, verifies entered postal code is valid via API

$(function(){

    // Validation for search form
    $("#searchForm").validate({

        // Called when form is filled in properly
        submitHandler: function(form) {
            form.submit();
        },

        rules: {
            "postal_code": {
                required: true,
                remote: {
                    url: "ajax/verify.php",
                    type: "GET",
                    // Verify postal code exists via API
                    data: {
                        "verify_type": "postal_code",
                        "verify_data": function() {
                            return $("#postal_code").val();
                        }
                    }
                }
            },
        },

        // Empty error messages, bootstrap indicators used instead
        messages: { "postal_code": {required: "", remote: ""} }

    });

});

