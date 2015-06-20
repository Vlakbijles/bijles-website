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
                    $("#modalTitle").text("Registreren");
                    $("#loginBody").addClass("hidden");
                    $("#registerBody").removeClass("hidden");
                    $("#registerFooter").removeClass("hidden");
                    $("#regEmail").val(data.email);
                    $("#regName").text(data.name);
                    $("#regSurname").text(data.surname);
                    $("#regPicture").attr("src", data.picture);
                    $("#regAccesstoken").val(data.access_token);
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
