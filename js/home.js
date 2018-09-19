$(document).ready(function() {
    console.log(navigator.onLine);
    checkInternetConnectivity();
});

function checkInternetConnectivity() {
    if (navigator.onLine) {
        $('#sign-in-form').attr('action', 'http://lamp.ms.wits.ac.za/~s815108/risk/ConnectDatabase.php');
    }
    else {
        $('#sign-in-form').attr('action', 'php/Signing/SignInOffline.php');
    }
}