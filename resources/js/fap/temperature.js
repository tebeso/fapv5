window.FapTemperature = class FapTemperature {
    constructor() {
        let $this = this;

        this.loadEvents();

        setInterval(
            function () {
                let title = $('#fap-page-title').text().trim();

                if (title === 'CABIN TEMPERATURE' || title === 'SETUP CABIN TEMPERATURE') {
                    $this.getTemperatureState();
                    $this.loadTempScale();

                    window.fapSensor.loadEvents();
                    window.fapSensor.getAssignedSensors('temp');
                }
                if (title === 'CABIN STATUS') {
                    $this.getTemperatureState();
                }
            },
            500,
        );
    }

    loadEvents() {
        let $this = this;

        $(document).on('click', '.fap-zone-switcher', function () {
            $('#fap-zone-switcher-box').find('.fap-button-active').removeClass('fap-button-active');
            $(this).addClass('fap-button-active');
            $this.loadTempScale();
        });

        $(document).on('click', '.temperature-setter-button', function () {
            if (!$(this).hasClass('fap-button-inactive')) {
                let sensorId = $(this).find('.fap-arrow').data('sensor-id');
                let mode     = $(this).data('mode');

                $.ajax({
                    type:    'GET',
                    data:    {mode: mode, sensorId: sensorId},
                    url:     'temperature/set-state',
                    timeout: 3000,
                });
            }
        });
    }

    loadTempScale() {
        let activeZoneButton = $('#fap-zone-switcher-box').find('.fap-button-active');
        let activeZone       = activeZoneButton.data('zone');
        let activeZoneBlock  = $('.temperature-block[data-zone="' + activeZone + '"]');
        let activeZoneTemp   = activeZoneBlock.text().trim();
        let activeZoneTarget = this.formatTemperature(activeZoneBlock.data('target'));

        $('#ball-temp').text(activeZoneTemp + '°C');
        $('.fap-box-title').first().text(activeZone);
        $('.fap-arrow').data('sensor-id', activeZoneBlock.data('sensor-id'));

        if (activeZoneTarget === false) {
            $('.fap-display-box').text('-');
            $('.fap-up-arrow').addClass('fap-arrow-inactive').parent().addClass('fap-button-inactive');
            $('.fap-down-arrow').addClass('fap-arrow-inactive').parent().addClass('fap-button-inactive');
        } else {
            $('.fap-display-box').text(activeZoneTarget + '°C');
            $('.fap-up-arrow').removeClass('fap-arrow-inactive').parent().removeClass('fap-button-inactive');
            $('.fap-down-arrow').removeClass('fap-arrow-inactive').parent().removeClass('fap-button-inactive');
        }

        let scaleTemp = this.revertFormatTemperature(activeZoneTemp);
        let scaleValue = 246;

        if (scaleTemp === 1700) {
            scaleValue = 215;
        } else if (scaleTemp === 1800) {
            scaleValue = 200;
        } else if (scaleTemp === 1900) {
            scaleValue = 185;
        } else if (scaleTemp === 2000) {
            scaleValue = 170;
        } else if (scaleTemp === 2100) {
            scaleValue = 155;
        } else if (scaleTemp === 2200) {
            scaleValue = 140;
        } else if (scaleTemp === 2300) {
            scaleValue = 125;
        } else if (scaleTemp === 2400) {
            scaleValue = 110;
        } else if (scaleTemp === 2500) {
            scaleValue = 95;
        } else if (scaleTemp === 2600) {
            scaleValue = 80;
        } else if (scaleTemp === 2700) {
            scaleValue = 65;
        } else if (scaleTemp === 2800) {
            scaleValue = 50;
        } else if (scaleTemp === 2900) {
            scaleValue = 35;
        } else if (scaleTemp === 3000) {
            scaleValue = 20;
        }

        $('.pipe-progress').css('height', scaleValue + 'px');
    }

    getTemperatureState() {
        let $this = this;

        $.ajax({
            type:    'GET',
            url:     'temperature/get-state-assigned',
            timeout: 3000,
            success: function (message) {

                $.each(message, function (position, attributes) {
                    let positionBlock = $('#temperature-' + position);
                    if (positionBlock.text() !== attributes.state) {
                        positionBlock.text($this.formatTemperature(attributes.state));
                        positionBlock.data('target', attributes.target);
                        positionBlock.data('sensor-id', attributes.sensor_id);
                    }
                });
            },
        });
    }

    roundHalf(num) {
        return Math.round(num / 100) * 100;
    }

    formatTemperature(temperature) {
        if (temperature === null || typeof temperature === 'undefined') {
            return false;
        }

        temperature = temperature.toString();

        if (temperature.length === 4) {
            return temperature.substring(0, 2) + '.' + temperature.substring(3, 4);
        } else {
            return temperature.substring(0, 1) + '.' + temperature.substring(2, 3);
        }
    }

    revertFormatTemperature(temperature) {
        temperature = temperature.toString();
        return this.roundHalf(temperature[0] + temperature[1] + '00');
    }
};