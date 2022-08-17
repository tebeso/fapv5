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
                SetupAudio.getFileList();
                $('#message').text(message).removeClass('red-text');
            },
            error:       function (message) {
                $('#message').text(JSON.parse(message.responseText)).addClass('red-text');
            },
        });
    });

    window.fileList = SetupAudio.getFileList();
</script>

<form action="setup/audio/upload" class="fap-content-box fap-box-small" style="top:100px; left: 30px;" method="post"
      enctype="multipart/form-data" id="upload-audio-form">
    @csrf
    <input type="file" id="audio-file" name="audio-file">
    <input type="submit" value="Submit">
</form>

<div class="fap-content-box fap-box-large" style="top:100px; right: 35px; display: flex;">
    <div style="width:50%; height: 85%;">
        <div class="fap-box-title"
             style="font-size: 17px; position: absolute; top: 150px; left: 100px;">FILE LIST
        </div>
        <ul id="audio-file-list" class="fap-list-box fap-box-small"
            style="height:165px; top:190px; left: 40px; width: 180px;">

        </ul>
        <div class="fap-button-group fap-button-group-4-vertical" style="top: 165px; left:230px;">
            <div class="fap-button-group">
                <div id="audio-file-list-up" class="fap-button" style="font-size: 19px;">
                    <div class="fap-arrow fap-up-arrow"></div>
                </div>
                <div class="fap-button fap-button-inactive" style="float:left;">
                    <div style="position: absolute; top:16px; left:13px;">Clear<br />Memo</div>
                </div>
                <div id="audio-file-clear-all" class="fap-button" style="float:left;">
                    <div style="position: absolute; top:16px; left:15px;">Clear<br />All</div>
                </div>
                <div id="audio-file-list-down" class="fap-button"
                     style="font-size: 19px;float:left; line-height: 55px;">
                    <div class="fap-arrow fap-down-arrow"></div>
                </div>
            </div>
        </div>
    </div>
    <div style="width: 50%; height: 85%; justify-content: center; display: flex; padding-top: 20px;">
        <div class="fap-box-title" style="font-size: 17px;">SELECT</div>
        <div id="audio-file-keypad-display" class="fap-display-box fap-box-tiny"
             style="top: 65px; line-height: 50px; text-align: center; font-size: 20px;"></div>

        <div style="top: 170px; position: absolute;">
            <div class="fap-button-group">
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">1</div>
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">2</div>
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">3</div>
            </div>
            <div class="fap-button-group">
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">4</div>
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">5</div>
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">6</div>
            </div>
            <div class="fap-button-group">
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">7</div>
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">8</div>
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">9</div>
            </div>
            <div class="fap-button-group">
                <div class="fap-button" id="audio-storage-numpad-clear">Clear</div>
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">0</div>
                <div class="fap-button" id="audio-storage-numpad-enter">Enter</div>
            </div>
        </div>
    </div>

    <div id="message" style="width: 100%; text-align: center; position:absolute; bottom: 15px;"></div>
</div>