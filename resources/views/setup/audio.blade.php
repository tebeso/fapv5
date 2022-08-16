<script>
    window.SetupAudio = new SetupAudio();
</script>

<form action="setup/audio/upload" class="fap-content-box fap-box-small" style="top:100px; left: 30px;" method="post"
      enctype="multipart/form-data" id="upload-audio-form">
    @csrf
    <input type="file" id="audio-file" name="audio-file">
    <input type="submit" value="Submit">
</form>

<div class="fap-content-box fap-box-large" style="top:100px; right: 35px; display: flex;">
    <div style="width:50%; height: 100%;">
        <div class="fap-list-box fap-box-small" style="height:185px;"></div>
    </div>
    <div style="width: 50%; height: 100%; justify-content: center; display: flex; padding-top: 20px;">
        <div class="fap-box-title" style="font-size: 17px; font-weight: 500;">SELECT</div>
        <div class="fap-display-box fap-box-tiny" style="top: 65px;"></div>

        <div style="top: 170px; position: absolute;">
            <div class="fap-button-group">
                <div class="fap-button" style="font-size: 19px;">1</div>
                <div class="fap-button" style="font-size: 19px;">2</div>
                <div class="fap-button" style="font-size: 19px;">3</div>
            </div>
            <div class="fap-button-group">
                <div class="fap-button" style="font-size: 19px;">4</div>
                <div class="fap-button" style="font-size: 19px;">5</div>
                <div class="fap-button" style="font-size: 19px;">6</div>
            </div>
            <div class="fap-button-group">
                <div class="fap-button" style="font-size: 19px;">7</div>
                <div class="fap-button" style="font-size: 19px;">8</div>
                <div class="fap-button" style="font-size: 19px;">9</div>
            </div>
            <div class="fap-button-group">
                <div class="fap-button">Clear</div>
                <div class="fap-button" style="font-size: 19px;">0</div>
                <div class="fap-button">Enter</div>
            </div>
        </div>
    </div>

</div>