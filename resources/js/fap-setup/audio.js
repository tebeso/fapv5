window.SetupAudio = class SetupAudio {

    constructor() {
        let $this = this;

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
                $this.storeAudioByNumber();
            });

            $(document).on('click', '#audio-storage-numpad-clear', function () {
                $this.keypadClear();
            });

            $(document).on('click', '#audio-file-clear-all', function () {
                $this.clearAll();
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

        this.selectFileListItem(audioFileList.children(':first'));
    }

    selectFileListItem(item) {
        $('.audio-file-list-item').removeClass('active');
        $(item).addClass('active');
    }

    nextFileListItemPage() {
        let hiddenItems   = $('#audio-file-list li:hidden');
        let visibleItems  = $('#audio-file-list li:visible');
        let nextPageItems = [];

        hiddenItems.each(function (_index, _data) {
            let hiddenItemId      = $(_data).data('id');
            let lastVisibleItemId = visibleItems.last().data('id');

            if (hiddenItemId > lastVisibleItemId && nextPageItems.length < 6) {
                nextPageItems.push(_data);
            }
        });

        if (nextPageItems.length !== 0) {
            visibleItems.hide();

            $(nextPageItems).each(function (_index, _data) {
                $(_data).show();
            });
        }
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
        return $.ajax({
            type:    'GET',
            url:     'setup/audio/get-audio-by-number',
            data:    {storageNumber: keypadDisplay.text()},
            error:       function (message) {
                $('#message').text(JSON.parse(message.responseText)).addClass('red-text');
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
            },
            error:       function (message) {
                $('#message').text(JSON.parse(message.responseText)).addClass('red-text');
            },
        });
    }

    clearAll() {
        let $this = this;

        return $.ajax({
            type:    'GET',
            url:     'setup/audio/clear-all',
            success: function (message) {
                $('#message').text(message).removeClass('red-text');
                $this.getFileList();
            },
            error:       function (message) {
                $('#message').text(JSON.parse(message.responseText)).addClass('red-text');
            },
        });
    }
};