window.FapLight = class FapLight {
    constructor() {

        let $this = this;
        setInterval(
            function () {
                let title = $('#fap-page-title').text().trim();

                if (title === 'LIGHTS' || title === 'SETUP LIGHTS' || title === 'CABIN STATUS') {
                    $this.getLightState();
                }
            },
            500,
        );

        $(document).on('click', '.light-button', function () {
            $this.setLightState($(this).parent().parent().attr('id').replace('button-', ''), $(this).parent().find('.fap-button-active').text(), $(this).text());
        });
    }

    setLightState(position, currentLevel, newLevel) {
        $.ajax({
            type: 'GET',
            data: {currentLevel: currentLevel, newLevel: newLevel, position: position},
            url:  'lights/set-state',
        });
    }

    getLightState() {
        $.ajax({
            type:    'GET',
            url:     'lights/get-state-assigned',
            success: function (message) {

                $.each(message, function (position, attributes) {
                    let buttonBox = $('#button-' + position);
                    let areaBox   = $('#lights-' + position);

                    let state = attributes.state;
                    let bri   = attributes.brightness;

                    buttonBox.find('.light-button').removeClass('fap-button-active');
                    areaBox.removeClass('lights-brt').removeClass('lights-dim1').removeClass('lights-dim2');

                    if (state === true) {
                        let level = 'BRT';
                        let css   = 'lights-brt';

                        if (bri <= 50) {
                            level = 'DIM 2';
                            css   = 'lights-dim2';
                        }
                        if (bri > 51 && bri <= 125) {
                            level = 'DIM 1';
                            css   = 'lights-dim1';
                        }

                        console.log('#light-' + position);
                        console.log(css);
                        console.log(areaBox);
                        areaBox.addClass(css);
                        buttonBox.find('.fap-button:contains(\'' + level + '\')').addClass('fap-button-active');
                    }
                });
            },
        });
    }
};