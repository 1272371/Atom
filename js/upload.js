$(document).ready(function() {

    // file input
    var input = document.getElementById('file-input');

    input.addEventListener('change', function(e) {

        // get files
        var file = input.files[0];

        // display file name
        var name = $('#file-input').val();
        var name = name.split('\\');

        $('#file-input-label').html(name[name.length - 1]);

        // read file
        readFile(file);

        document.getElementById('UploadButton').onclick = function () {readFile(file)};
    });

});

document.ondragend = function(event) {

    $('body').css('filter', 'blur(0px)');

    return false;
}

document.ondragleave = function(event) {

    $('body').css('filter', 'blur(0px)');

    return false;
}

document.ondragover = function(event) {

    $('body').css('filter', 'blur(1px)');

    return false;
}

document.ondrop = function(event) {

    $('body').css('filter', 'blur(0px)');

    event.preventDefault();

    // get file
    var file = event.dataTransfer.files[0];

    // set name
    $('#file-input-label').html(file.name);

    // read file
    readFile(file);
}

function drag_drop(event) {
    event.preventDefault();

    var file = event.dataTransfer.files[0];

    readFile(file);
}

function readFile(file){
    var textType = file.type;
    var fileDisplayArea = document.getElementById('fileDisplayArea');
    if (file.type.match(textType)) {
        var reader = new FileReader();

        reader.onload = function(e) {
            fileDisplayArea.innerText = reader.result;
            var upload = reader.result;

            displayFile(upload);
        }
        reader.readAsText(file);

    }
    else {
        fileDisplayArea.innerText = "File not supported!";
    }
}

function displayFile(upload) {

    var splitted = upload.split('\n');
}