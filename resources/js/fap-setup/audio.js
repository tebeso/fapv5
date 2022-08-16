window.SetupAudio = class SetupAudio {
    constructor() {
        $('#upload-audio-form').submit(function (e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            $.ajax({
                type:        'POST',
                url:         $(this).attr('action'),
                data:        new FormData(this), // serializes the form's elements.
                processData: false,
                contentType: false,
                success:     function () {
                    $('#upload-audio-form')[0].reset();
                },
            });
        });

        window.fileList = this.getFileList();
    }

    getFileList() {
        return $.ajax({
            type:        'GET',
            url:         'setup/audio/get-file-list',
            processData: false,
            contentType: false,
            success:     function (_index, data) {
                console.log(_index);
            },
        });
    }
};