window.onload = function() {
    var fileInput = document.getElementById('fileInput');
    fileInput.addEventListener('change', function(e) {
        file = fileInput.files[0];
        preview(file)

    });
    document.getElementById('UploadButton').onclick = function () {Upload_to_db()};
}
var file;

function drag_drop(event) {
    event.preventDefault();
    file = event.dataTransfer.files[0];
    preview(file);
}

function preview(file){
    var textType = file.type;
    var fileDisplayArea = document.getElementById('fileDisplayArea');
    if (file.type.match(textType)) {
        var reader = new FileReader();

        reader.onload = function(e) {
            fileDisplayArea.innerText = reader.result;
        }

        reader.readAsText(file);
    } else {
        fileDisplayArea.innerText = "File not supported!";
    }
}

