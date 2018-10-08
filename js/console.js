/**
 * cosmetics
 */
// body and html
$('body,html').attr('style','overflow-x:hidden;max-height:100vh');

// side navigation
$('#side-nav-bar').attr('style', 'background-color: #242424;min-height: 100vh; height: 100%; overflow:hidden');

/**
 * function runs immediately
 */
$(document).ready(function() {

    // set title
    Welcome();

});

/**
 * functions
 */
function Welcome() {

    $.ajax({
        url : 'api/signing/signed.php', // url
        method : 'POST', // method
        dataType : 'JSON',
        success : function(data) {
            
            if (data.message === 'success') {
                // redirect to dashboard
                $('#dev-id').html(
                    '>>> Signed in as, ' + 
                    data.contents.user_name + ' ' +
                    data.contents.user_surname + data.contents.user_type);
            }
        }
    });

}