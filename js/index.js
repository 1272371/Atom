/**
 * cosmetics
 */
$('body,html').css('overflow-x','hidden');

/**
 * functions
 */
function SignIn(username, password) {

    var username = $('#username').val();
    var password = $('#password').val();

    $.ajax({
        url : "api/signing/login.php", // url
        method : "POST", // method
        data:{username : username, password : password},
        dataType : "JSON",
        success : function(data) {
            
            if (data.message === 'success') {
                // redirect to dashboard
                window.location.href = 'dashboard/dashboard.php';
            }
            else if (data.message === 'error') {
                ResponseModal('Incorrect username or password, please try again');
            }
        }
    });
}

/**
 * events
 */
$('#sign-in-button').click(function() {
    SignIn();
});