function readURL(input, parentSelector) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();

        reader.onload = function(e) {
            let inputLabel = $(parentSelector + ' .input-label');
            inputLabel.css('background-image', `url('${e.target.result}')`);
            inputLabel.css('background-repeat', 'no-repeat');
            inputLabel.css('background-size', 'contain');
            inputLabel.css('background-position', 'center');
        };

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

function showFileName(input, parentSelector) {
    let fakePath = $(input).val();
    let fileName = fakePath.split("\\").pop();
    let fileNamePreview = $(parentSelector + ' .file-name-preview');
    fileNamePreview.removeClass('d-none');
    fileNamePreview.text(fileName)
}

$("#passport").change(function() {
    readURL(this, '#passport-input');
});

$("#guarantor-passport").change(function() {
    readURL(this, '#guarantor-passport-input');
});

$("#cv").change(function() {
    showFileName(this, '#cv-input');
});
