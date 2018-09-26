var tableCount = 1;

// button declaration
var upload = $('#upload');
var add = $('#add-table');
var remove = $('#remove-table');

$(document).ready(function() {

    $('.roundness').attr("style", "border-radius: 50%;");
    
});

/**
 * functions
 */

function addAssessment() {

    // transition
}

/**
 * element events
 */

// add table button
$('#add-table').click(function() {
    addAssessment();
});

upload.on('change', function(event) {
    var files = ($('#upload').val()).split("\\");
    var filelength = files.length;
    var filename = files[filelength - 1];

    var reader = new FileReader();
    reader.readAsDataURL(upload.prop('files')[0]);
    reader.onloadend = function(event) {
        console.log(event.target.result);
    }

    //console.log(upload.prop('files')[0].path);
});

$('#uploads').click(function() {
    $.ajax({
        url:"csv/random-user.csv",
        dataType:"text",
        success:function(data) {
            var row = data.split(/\r?\n|\r/);
            var table = '<table class="table table-hover table-bordered table-striped">';

            // append head row
            var thead = row[0].split(",");
            table += '<thead class="thead-dark"><tr>';
            for (var i = 0; i < thead.length; i++) {
                table += '<th scope="col">' + thead[i] + '</th>';
            }
            table += '</tr></thead><tbody>'
            for (var count = 1; count < row.length; count++) {
                var cell = row[count].split(",");
                table += '<tr scope="row">';
                for (var column = 0; column < cell.length; column++) {
                    if (column < 1) {
                        table += '<td>' + cell[column] + '</td>';
                    }
                    else {
                        table += '<td><div contenteditable>' + cell[column] + '</div></td>';
                    }
                }
                table += '</tr>';
            }
            table += '</tbody></table>';
            $('#tables').html(table);
        }
    });
});