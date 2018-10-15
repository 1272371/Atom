// height variable for card
var cardHeight
var areaHeight

$(document).ready(function() {

    if ($('#config-card').length === 1) {
        // set card top for adjusting bottom-border
        cardHeight = $('#config-card').offset().top
        areaHeight = $('#display-area').offset().top
    }

})

$(window).on('resize', function() {
    
    // adjusts bottom-border of file preview card
    if ($('#config-card').length === 1) {
        var height = $(window).height() - cardHeight - 10;
        var area = $(window).height() - areaHeight - 20;
        $('#config-card').css('height', height)
        $('#display-area').css('height', area)
    }
})