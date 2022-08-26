window.FapSensor = class FapSensor {
    constructor() {
        this.getAssignedSensors();
        this.getTemperatureState();

        let $this = this;

        setInterval(
            function () {
                let title = $('#fap-page-title').text().trim();

                if (title === 'CABIN TEMPERATURE' || title === 'SETUP CABIN TEMPERATURE' || title === 'CABIN STATUS') {
                    $this.getTemperatureState();
                    $this.loadTempScale();
                }
            },
            500,
        );

        $(document).on('click', '.fap-zone-switcher', function () {
            $('#fap-zone-switcher-box').find('.fap-button-active').removeClass('fap-button-active');
            $(this).addClass('fap-button-active');
            $this.loadTempScale();
        });
    }

    loadTempScale() {
        let activeZoneButton = $('#fap-zone-switcher-box').find('.fap-button-active');
        let activeZone       = activeZoneButton.data('zone');
        let activeZoneTemp   = $('.temperature-block[data-zone="' + activeZone + '"]').text().trim();
        let scaleTemp        = this.roundHalf(activeZoneTemp);
        $('#ball-temp').text(activeZoneTemp + '°C');

        let scaleValue = 200;
        if (scaleTemp === 17) {
            scaleValue = 187;
        } else if (scaleTemp === 18) {
            scaleValue = 177;
        } else if (scaleTemp === 19) {
            scaleValue = 164;
        } else if (scaleTemp === 20) {
            scaleValue = 153;
        } else if (scaleTemp === 21) {
            scaleValue = 131;
        } else if (scaleTemp === 22) {
            scaleValue = 129;
        } else if (scaleTemp === 23) {
            scaleValue = 116;
        } else if (scaleTemp === 24) {
            scaleValue = 104;
        } else if (scaleTemp === 25) {
            scaleValue = 92;
        } else if (scaleTemp === 26) {
            scaleValue = 80;
        } else if (scaleTemp === 27) {
            scaleValue = 68;
        } else if (scaleTemp === 28) {
            scaleValue = 56;
        } else if (scaleTemp === 29) {
            scaleValue = 44;
        } else if (scaleTemp === 30) {
            scaleValue = 32;
        }

        let scaleSecondaryValue = 200 - scaleValue;
        $('.pipe').css('background-size', scaleSecondaryValue + '% ' + scaleValue + '%');
    }

    getAssignedSensors() {
        $.ajax({
            type:    'GET',
            url:     'setup/sensors/get-assigned-sensors',
            data:    {type: 'temp'},
            success: function (message) {
                $.each(JSON.parse(message), function (position, sensor) {
                    $('#' + position).val(sensor);
                });
            },
        });
    }

    getTemperatureState() {
        $.ajax({
            type:    'GET',
            url:     'temperature/get-state-assigned',
            success: function (message) {

                $.each(message, function (position, attributes) {
                    let positionBlock = $('#temperature-' + position);
                    if (positionBlock.text() !== attributes.state) {
                        positionBlock.text(attributes.state);
                    }
                });
            },
        });
    }

    roundHalf(num) {
        return Math.round(num);
    }
};