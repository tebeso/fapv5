window.FapAdmin = class FapAdmin {
    constructor() {
        let $this = this;
        setInterval(
            function () {
                let title = $('#fap-page-title').text().trim();

                if (title === 'BRIDGE SETUP') {
                    $this.checkPaired();
                }
            },
            1000,
        );
    }

    deleteBridge(bridge) {
        $.ajax({
            type:    'GET',
            url:     'admin/bridge-setup/delete',
            timeout: 3000,
            data:    {bridge: bridge},
            success: function () {
                window.fapMain.showPopup('Bridge deleted.');
            },
        });
    }

    pairBridge(bridge) {
        let response = $.ajax({
            type:    'GET',
            url:     'admin/bridge-setup/pair',
            timeout: 60000,
            async:   false,
            data:    {bridge: bridge},
        });

        window.fapMain.showPopup(response.responseText);
    }

    pairDevice() {
        let response = $.ajax({
            type:    'GET',
            url:     'admin/bridge-setup/pair-device',
            timeout: 60000,
            async:   false,
        });

        window.fapMain.showPopup(response.responseText);
    }

    checkPaired() {
        let response = JSON.parse($.ajax({
            type:    'GET',
            url:     'admin/bridge-setup/check-paired',
            timeout: 1000,
            async:   false,
        }).responseText);

        let hueStatus     = $('#hue-bridge-status');
        let raspbeeStatus = $('#raspbee-bridge-status');

        if (response.raspbeeUser === null) {
            raspbeeStatus.addClass('red-text').removeClass('green-text').text('not paired');
        } else {
            raspbeeStatus.removeClass('red-text').addClass('green-text').text('paired');
        }

        if (response.hueUser === null) {
            hueStatus.addClass('red-text').removeClass('green-text').text('not paired');
        } else {
            hueStatus.removeClass('red-text').addClass('green-text').text('paired');
        }
    }
};