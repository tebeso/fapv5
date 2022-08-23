<script>
    setInterval(function() {
        window.fapAudio.setVolumeState();
    }, 200);
</script>

@include('audio.aircraft')

<div class="fap-content-box fap-box-small" style="top:165px; left:165px; height: 190px;">
    <div style="left:75px; font-size:19px; position: relative;">BGM1</div>
    <div class="fap-button-group-3-horizontal" style="position:relative; left:15px">
        <div class="fap-button fap-button-active">ON /<br />OFF</div>
        <div class="fap-button" style="font-size: 19px;"><div class="fap-arrow fap-up-arrow" onclick="window.fapAudio.volumeUp();"></div></div>
        <div class="fap-button fap-button-inactive" style="font-size: 19px;"><div class="fap-arrow fap-up-arrow fap-arrow-inactive"></div></div>
    </div>
    <div class="fap-button-group-2-horizontal" style="position:relative; left:70px;">
        <div class="fap-button" style="font-size: 19px;"><div class="fap-arrow fap-down-arrow" onclick="window.fapAudio.volumeDown();"></div></div>
        <div class="fap-button fap-button-inactive" style="font-size: 19px;"><div class="fap-arrow fap-down-arrow fap-arrow-inactive"></div></div>
    </div>
    <div style="left:80px; top:2px; position: relative;">VOL.</div>
    <div style="top:-14px; left:130px; position: relative;">CHAN.</div>
</div>

<div class="fap-content-box fap-box-large" style="top:100px; right: 35px; display: flex;">
    <div style="width:50%; height: 85%;">
        <div id="audio-current-file" class="fap-display-box fap-box-tiny" style="position: absolute; top:75px; left:40px; width:180px; line-height: 50px; text-align: center;"></div>
        <div class="fap-box-title"
             style="font-size: 17px; position: relative; top: 150px;">MEMO
        </div>
        <ul id="audio-file-list" class="fap-list-box fap-box-small"
            style="height:165px; top:190px; left: 40px; width: 180px;">

        </ul>
        <div class="fap-button-group fap-button-group-4-vertical" style="top: 143px; left:230px;">
            <div class="fap-button-group">
                <div id="audio-file-list-up" class="fap-button fap-button-inactive" style="font-size: 19px;">
                    <div class="fap-arrow fap-up-arrow fap-arrow-inactive"></div>
                </div>
                <div id="audio-file-clear-file" class="fap-button fap-button-inactive" style="float:left;">
                    <div style="position: relative; top:16px;">Clear<br />File</div>
                </div>
                <div id="audio-file-clear-all" class="fap-button fap-button-inactive" style="float:left;">
                    <div style="position: relative; top:16px;">Clear<br />All</div>
                </div>
                <div id="audio-file-list-down" class="fap-button fap-button-inactive"
                     style="font-size: 19px;line-height: 55px;">
                    <div class="fap-arrow fap-down-arrow fap-arrow-inactive"></div>
                </div>
            </div>
        </div>

        <div class="fap-button-group-big" style="top:140px;left:60px;">
            <div class="fap-button  fap-button-function" onclick="window.fapAudio.stop();">Stop</div>
            <div class="fap-button  fap-button-function" onclick="window.fapAudio.pause();">Pause</div>
            <div class="fap-button  fap-button-function" onclick="window.fapAudio.play();">Play</div>
        </div>
    </div>
    <div style="width: 50%; height: 85%; padding-top: 20px;">
        <div class="fap-box-title" style="font-size: 17px; height:30px; width:100%;">SELECT</div>
        <div id="audio-file-keypad-display" class="fap-display-box fap-box-tiny"
             style="top: 75px; line-height: 50px; text-align: center; font-size: 20px; right:70px; width:150px"></div>

        <div style="top: 115px; left: 65px; position: relative;">
            <div class="fap-button-group" style="width: 170px;">
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">1</div>
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">2</div>
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">3</div>
            </div>
            <div class="fap-button-group" style="width: 170px;">
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">4</div>
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">5</div>
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">6</div>
            </div>
            <div class="fap-button-group" style="width: 170px;">
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">7</div>
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">8</div>
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">9</div>
            </div>
            <div class="fap-button-group" style="width: 170px;">
                <div class="fap-button" id="audio-storage-numpad-clear">Clear</div>
                <div class="fap-button audio-storage-numpad" style="font-size: 19px;">0</div>
                <div class="fap-button fap-button-inactive" id="audio-storage-numpad-enter">Enter</div>
            </div>
        </div>
    </div>
</div>

@yield('audio-upload-form')