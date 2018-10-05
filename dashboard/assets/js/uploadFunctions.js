window.onload = function() {
    var fileInput = document.getElementById('fileInput');
    var fileDisplayArea = document.getElementById('fileDisplayArea');

    fileInput.addEventListener('change', function(e) {
        var file = fileInput.files[0];
        var textType = file.type;

        if (file.type.match(textType)) {
            var reader = new FileReader();

            reader.onload = function(e) {
                fileDisplayArea.innerText = reader.result;
            }
            reader.readAsText(file);
        } else {
            fileDisplayArea.innerText = "File not supported!";
        }
    });
}

function drag_drop(event) {
    event.preventDefault();



    var fileDisplayArea = document.getElementById('fileDisplayArea');
    var file = event.dataTransfer.files[0];
    var textType = file.type;

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