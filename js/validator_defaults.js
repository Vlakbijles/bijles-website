// validator_defaults.js
//
// Set defaults for jQuery Validate plugin

$(function(){

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

});
