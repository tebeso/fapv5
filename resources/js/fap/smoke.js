window.FapSmoke = class FapSmoke {
    constructor() {
        let $this = this;

        setInterval(
            function () {
                let title = $('#fap-page-title').text().trim();

                if (title === 'SETUP SMOKE DETECTION' || title === 'SMOKE DETECTION') {
                    $this.getSmokeDetectionState();
                }
                if (title === 'CABIN STATUS') {
                    $this.getSmokeDetectionState();
                }
            },
            500,
        );
    }

    getSmokeDetectionState() {
        $.ajax({
            type:    'GET',
            url:     'smoke-detection/get-state-assigned',
            timeout: 3000,
            success: function (message) {
                $.each(message, function (position, attributes) {
                    position = position.replace('select-', '');
                    console.log(position);
                    console.log(attributes);
                });
            },
        });
    }
};