// validator_search.js
//
// Validator for search form, verifies entered postal code is valid via API

// Dependencies (must at some point be included in html):
// -

$(function(){

    // Validation for search form
    $("#searchForm").validate({

        // Called when form is filled in properly
        submitHandler: function(form) {
            // Exclude subject name string from submit
            // $("#searchSubjectName").remove();
            // $("#searchSubjectName").prop("disabled",true);
            form.submit();
        },

        rules: {
            "subject_name": {
                required: true,
                remote: {
                    url: "/ajax/verify.php",
                    type: "GET",
                    // Verify subject exists via API
                    data: {
                        "verify_type": "subject",
                        "verify_data": function() {
                            return $("#searchSubjectId").val();
                        }
                    }
                }
            },
            "postal_code": {
                required: true,
                remote: {
                    url: "/ajax/verify.php",
                    type: "GET",
                    // Verify postal code exists via API
                    data: {
                        "verify_type": "postal_code",
                        "verify_data": function() {
                            return $("#searchPostalCode").val();
                        }
                    }
                }
            },
        },

        // Empty error messages, bootstrap indicators used instead
        messages: { "subject_name": {required: "", remote: ""},
                    "postal_code": {required: "", remote: ""} }

    });

});

