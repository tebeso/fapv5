window.FapAudio = class FapAudio {
    constructor() {
        let $this = this;

        setInterval(function () {
            let title = $('#fap-page-title').text().trim();
            if (title === 'AUDIO' || title === 'SETUP AUDIO') {
                $this.setVolumeState();
            }
            if (title === 'CABIN STATUS') {
                $this.setVolumeState();
            }
        }, 500);


        $(document).ready(function () {

            $(document).on('click', '#audio-file-list li', function () {
                $this.selectFileListItem($(this));
            });

            $(document).on('click', '#audio-file-list-down', function () {
                $this.nextFileListItemPage();
            });

            $(document).on('click', '#audio-file-list-up', function () {
                $this.prevFileListItemPage();
            });

            $(document).on('click', '.audio-storage-numpad', function () {
                $this.keypadWrite($(this).text());
            });

            $(document).on('click', '#audio-storage-numpad-enter', function () {
                if ($(this).hasClass('fap-button-inactive') === false) {
                    $this.storeAudioByNumber();
                }
            });

            $(document).on('click', '#audio-storage-numpad-clear', function () {
                $this.keypadClear();
            });

            $(document).on('click', '#audio-file-clear-all', function () {
                if ($(this).hasClass('fap-button-inactive') === false) {
                    $this.clearAll();
                }
            });

            $(document).on('click', '#audio-file-clear-file', function () {
                if ($(this).hasClass('fap-button-inactive') === false) {
                    $this.clearFile();
                }
            });
        });
    }

    getFileList() {
        let $this = this;

        return $.ajax({
            type:        'GET',
            url:         'setup/audio/get-file-list',
            processData: false,
            contentType: false,
            success:     function (files) {
                window.fileList = files;
                $this.makeFileListTable(files);
            },
        });
    }

    makeFileListTable() {
        let audioFileList = $('#audio-file-list');

        audioFileList.empty();

        $(window.fileList).each(function (_index, filename) {
            $('#audio-file-list').append('<li class="audio-file-list-item" id="audio-file-list-' + _index + '" data-id="' + _index + '">' + filename + '</li>');

        });

        let visibleItems  = $('#audio-file-list li:visible');

        visibleItems.first().css('border-top', 'none');
        visibleItems.last().css('border-bottom', 'none');

        this.selectFileListItem(audioFileList.children(':first'));
    }

    selectFileListItem(item) {
        let $this = this;

        $('.audio-file-list-item').removeClass('active');
        $(item).addClass('active');

        $(document).ready(function () {
            let source = 'audio-files/' + $(item).text();

            $this.setAudio(source);
        });
    }

    nextFileListItemPage() {
        let hiddenItems   = $('#audio-file-list li:hidden');
        let visibleItems  = $('#audio-file-list li:visible');
        let nextPageItems = [];

        hiddenItems.each(function (_index, _data) {
            let hiddenItemId      = $(_data).data('id');
            let lastVisibleItemId = visibleItems.last().data('id');

            if (hiddenItemId > lastVisibleItemId && nextPageItems.length < 5) {
                nextPageItems.push(_data);
            }
        });

        if (nextPageItems.length !== 0) {
            visibleItems.hide();

            $(nextPageItems).each(function (_index, _data) {
                $(_data).show();
            });
        }

        visibleItems.first().css('border-top', 'none');
        visibleItems.last().css('border-bottom', 'none');
    }

    prevFileListItemPage() {
        let hiddenItems   = $('#audio-file-list li:hidden');
        let visibleItems  = $('#audio-file-list li:visible');
        let prevPageItems = [];

        hiddenItems.each(function (_index, _data) {
            let hiddenItemId       = $(_data).data('id');
            let firstVisibleItemId = visibleItems.first().data('id');

            if (hiddenItemId < firstVisibleItemId) {
                prevPageItems.push(_data);
            }
        });

        if (prevPageItems.length !== 0) {
            visibleItems.hide();

            $(prevPageItems).slice(-5).each(function (_index, _data) {
                $(_data).show();
            });
        }

        visibleItems.first().css('border-top', 'none');
        visibleItems.last().css('border-bottom', 'none');
    }

    keypadWrite(string) {
        let keypadDisplay = $('#audio-file-keypad-display');

        if (keypadDisplay.text().length < 4) {
            keypadDisplay.text(keypadDisplay.text() + string);

            this.getAudioByNumber();
        }
    }

    keypadClear() {
        let keypadDisplay = $('#audio-file-keypad-display');

        keypadDisplay.empty();
    }

    getAudioByNumber() {
        let keypadDisplay = $('#audio-file-keypad-display');
        let $this         = this;

        return $.ajax({
            type:    'GET',
            url:     'setup/audio/get-audio-by-number',
            data:    {storageNumber: keypadDisplay.text()},
            success: function (data) {
                if (data !== false) {
                    let source = 'audio-files/' + data;

                    $this.setAudio(source);
                }
            },
            error:   function (message) {
                window.fapMain.showPopup(JSON.parse(message.responseText));
            },
        });
    }

    storeAudioByNumber() {
        let keypadDisplay = $('#audio-file-keypad-display');
        let selectedAudio = $('.audio-file-list-item.active');

        if (keypadDisplay.text().trim() === '') {
            return;
        }

        return $.ajax({
            type:    'GET',
            url:     'setup/audio/store-audio-by-number',
            data:    {
                storageNumber: keypadDisplay.text(),
                selectedAudio: selectedAudio.text(),
            },
            success: function (message) {
                $('#message').text(message).removeClass('red-text');
                window.fapMain.showPopup(message);
            },
            error:   function (message) {
                window.fapMain.showPopup(JSON.parse(message.responseText));
            },
        });
    }

    clearAll() {
        let $this = this;

        return $.ajax({
            type:    'GET',
            url:     'setup/audio/clear-all',
            success: function (message) {
                $this.getFileList();
                window.fapMain.showPopup(message);
            },
            error:   function (message) {
                window.fapMain.showPopup(JSON.parse(message.responseText));
            },
        });
    }

    clearFile() {
        let $this = this;

        return $.ajax({
            type:    'GET',
            data:    {filename: $('#audio-file-list').find('.active').text()},
            url:     'setup/audio/clear-file',
            success: function (message) {
                $this.getFileList();
                window.fapMain.showPopup(message);
            },
            error:   function (message) {
                window.fapMain.showPopup(JSON.parse(message.responseText));
            },
        });
    }

    setAudio(source) {
        let audio     = $('#fap-audio')[0];
        let audioFile = $('#fap-audio-file');

        audioFile.attr('src', source);
        audio.pause();
        audio.load();

        this.setAudioDisplay(audioFile.attr('src'));
    }

    setAudioDisplay(text) {
        $('#audio-current-file').text(text.replace('audio-files/', '').replace(/\.[^/.]+$/, ''));
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

    getVolume() {
        let audioPlayer = $('#fap-audio');

        return audioPlayer.prop('volume') * 10;
    }

    setVolumeState() {
        let volume                = Math.round(this.getVolume());
        let audioVolumeState      = $('#audio-volume-state');
        let audioVolumeStateItems = audioVolumeState.children('li');
        let activeVolElem         = audioVolumeStateItems.slice(-volume);

        audioVolumeStateItems.removeClass('active');

        if (volume !== 0) {
            activeVolElem.each(function () {
                $(this).addClass('active');
            });
        }
    }

    volumeUp(step = 0.1) {
        let audioPlayer = $('#fap-audio');
        let newVolume   = audioPlayer.prop('volume') + step;

        if (newVolume > 1.0) {
            newVolume = 1.0;
        }

        audioPlayer.prop('volume', newVolume);
    }

    volumeDown(step = 0.1) {
        let audioPlayer = $('#fap-audio');
        let newVolume   = audioPlayer.prop('volume') - step;

        if (newVolume < 0.0) {
            newVolume = 0.0;
        }

        audioPlayer.prop('volume', newVolume);
    }
};