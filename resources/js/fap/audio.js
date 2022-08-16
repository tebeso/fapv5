window.FapAudio = class FapAudio {
    constructor() {
        let $this = this;

        $(document).ready(function () {
            $(document).on('click', '.fap-audio', function () {
                $this.setAudio($(this).data('audio'));
                $this.play();
            });
        });
    }

    setAudio(source) {
        let audio = $('#fap-audio')[0];

        $('#fap-audio-file').attr('src', source);
        audio.pause();
        audio.load();
    }

    play() {
        let audio = $('#fap-audio')[0];

        audio.play();
    }

    pause() {
        let audio = $('#fap-audio')[0];

        if (audio.paused === true) {
            audio.play();
        } else {
            audio.pause();
        }
    }

    stop() {
        let audio = $('#fap-audio')[0];

        audio.pause();
        audio.currentTime = 0;
    }

    volumeUp() {
        let audioPlayer = $('#fap-audio');
        let newVolume   = audioPlayer.prop('volume') + 0.1;

        if(newVolume > 1.0){
            newVolume = 1.0;
        }

        audioPlayer.prop('volume', newVolume);
    }

    volumeDown() {
        let audioPlayer = $('#fap-audio');
        let newVolume   = audioPlayer.prop('volume') - 0.1;

        if(newVolume < 0.0){
            newVolume = 0.0;
        }

        audioPlayer.prop('volume', newVolume);
    }
};