$(function() {

    $("#sign-in-form-user").focusout(function() {
        //
        check_user();
    });

    $("#sign-in-form-user").focusout(function() {
        //
        check_pass();
    });

    $("#sign-in-form").submit(function() {

        var user_length = $("#sign-in-form-user").val().length;
        var pass_length = $("#sign-in-form-pass").val().length;

        if (user_length < 1) {
            
        }
        if (pass_length < 1) {

        }
    });

    function check_user() {

        var user_length = $("sign-in-form-user").val().length;

    }

    function check_pass() {

        var user_length = $("sign-in-form-pass").val().length;

    }

});