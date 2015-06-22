// fbconnect.js
//
// Tries to connect using facebook,
// when connected for the first time prompt the user to register


// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        getFacebookData(response);
    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.
    } else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.
    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

function getFacebookData(response) {
    $.ajax({
        url: "ajax/fb_auth.php",
        type: "POST",
        dataType: "json",
        data: {"access_token": response.authResponse.accessToken}})
        .done(function(data, status, xhr) {
            switch (xhr.status) {
                case 200:
                    // 200, means account exists with this fb account reload page
                    // for correct rendering
                    location.reload();
                    break;
                case 202:
                    // 202, means account doesn't exists with this fb account,
                    // so prompt user to make one
                    registerForm(data);
                    break;
                default:
                    ;
            }
        })
        .fail(function( jqXHR, textStatus ) {
            // Something went wrong, log error
            console.log("Request failed: " + textStatus);
        });

}



window.fbAsyncInit = function() {
    FB.init({
        appId      : '1597503327174282',
        cookie     : true,  // enable cookies to allow the server to access
        // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.2' // use version 2.2
    });


    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });

};

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));



function registerForm(data){

    $("#modalTitle").text("Registreren");
    $("#loginBody").addClass("hidden");
    $("#registerBody").removeClass("hidden");
    $("#registerFooter").removeClass("hidden");
    $("#regEmail").val(data.email);
    $("#regName").text(data.name);
    $("#regSurname").text(data.surname);
    $("#regPicture").attr("src", data.picture);
    $("#regAccessToken").val(data.access_token);

    // Char counter logic
    var maxLength = 1000;
    var currentLength = $("#regDesc").val().length;
    $("#charCounter").text(currentLength + "/" + maxLength).fadeTo(0, 0.2);
    $("#regDesc")
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
    $("#registerForm").validate({

        // Called when form is filled in properly
        submitHandler: function(form) {

            var Email = $(form).find("#regEmail").val();
            var accessToken = $(form).find("#regAccessToken").val()
            var PostalCode = $(form).find("#regPostalCode").val();
            var Desc = $(form).find("#regDesc").val();

            $.ajax({
                url: "ajax/register.php",
                type: "POST",
                dataType: "json",
                data: {"email": Email,
                       "access_token": accessToken,
                       "postal_code": PostalCode,
                       "description": Desc},
                statusCode: {
                    // 400 indicates the email address is already in use, the
                    // postal code does not exist or that the max description
                    // length is exceeded
                    400:
                        function(data) {
                            console.log(data);
                            if (data.responseJSON.message.match("Postal code")) {
                                $("#regPostalCode").closest(".form-group").addClass("has-error");
                            } else if (data.responseJSON.message.match("Email")) {
                                $("#regEmail").closest(".form-group").addClass("has-error");
                            } else {
                                alert('ALASD???');
                            }
                        }
                }})
                .done(function(data) {
                    location.reload();
                });
        },

        rules: {
            "regEmail": {
                required: true,
                email: true,
                remote: {
                    url: "ajax/verify.php",
                    type: "GET",
                    data: {
                        "verify_type": "email",
                        "verify_data": function() {
                            return $("#regEmail").val();
                        }
                    }
                }
            },
            "regAccessToken": {
                required: true,
            },
            "regPostalCode": {
                required: true,
                postalcode: true,
                remote: {
                    url: "ajax/verify.php",
                    type: "GET",
                    data: {
                        "verify_type": "postal_code",
                        "verify_data": function() {
                            return $("#regPostalCode").val();
                        }
                    }
                }
            },
            "regDesc": {
                maxlength: 1000,
            },
        },

        // Empty error messages, bootstrap indicators used instead
        messages: { "regEmail": {required: "", email: "", remote: ""},
                    "regAccessToken": {required: ""},
                    "regPostalCode": {required: "", postalcode: "", remote: ""},
                    "regDesc": {maxlength: ""} }

    });


}
