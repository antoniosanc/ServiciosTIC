$('.summer').summernote({
    height: "200px",
    callbacks: {
        onImageUpload: function(files) {
            url = $(this).data('upload'); //path is defined as data attribute for  textarea
            sendFile(files[0], url, $(this));
        }
    }
});

function sendFile(file, url, editor) {
    var data = new FormData();
    data.append("file", file);
    var request = new XMLHttpRequest();
    request.open('POST', url, true);
    request.onload = function() {
        if (request.status >= 200 && request.status < 400) {
            // Success!
            var resp = request.responseText;
            editor.summernote('insertImage', resp);
            console.log(resp);
        } else {
            // We reached our target server, but it returned an error
            var resp = request.responseText;
            console.log(resp);
        }
    };
    request.onerror = function(jqXHR, textStatus, errorThrown) {
        // There was a connection error of some sort
        console.log(jqXHR);
    };
    request.send(data);
}