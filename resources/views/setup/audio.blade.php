@extends('audio')

@section('audio-upload-form')
    <form action="setup/audio/upload" class="fap-content-box fap-box-small"
          style="top:400px; left: 165px; height:100px; line-height:50px; padding-left:10px" method="post"
          enctype="multipart/form-data" id="upload-audio-form">
        @csrf
        <input type="file" id="audio-file" name="audio-file"
               style="width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
        <div class="fap-button" onclick="$('#upload-audio-form').submit()"
             style="position: absolute; top:45px; left:150px;line-height: 55px;">Upload
        </div>
    </form>

    <script>

        $('#upload-audio-form').submit(function (e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            $.ajax({
                type:        'POST',
                url:         $(this).attr('action'),
                data:        new FormData(this), // serializes the form's elements.
                processData: false,
                contentType: false,
                success:     function (message) {
                    $('#upload-audio-form')[0].reset();
                    window.fapAudio.getFileList();
                    window.fapMain.showPopup(message);
                },
                error:       function (message) {
                    window.fapMain.showPopup(JSON.parse(message.responseText));
                },
            });
        });


        window.fapAudio.getFileList();

        /**
         * Active items that are inactive on the normal audio page.
         */
        audioStorageBox = $('.fap-box-large');

        audioStorageBox.find('.fap-button-inactive').each(function () {
            $(this).removeClass('fap-button-inactive');
        });

        audioStorageBox.find('.fap-arrow-inactive').each(function () {
            $(this).removeClass('fap-arrow-inactive');
        });
    </script>
@endsection
