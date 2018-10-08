$(document).ready(function() {

    // file input
    var fileInput = document.getElementById('file-input');

    fileInput.addEventListener('change', function(e) {
        var file = fileInput.files[0];
        readFile(file)
        document.getElementById('UploadButton').onclick = function () {readFile(file)};
    });

});

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