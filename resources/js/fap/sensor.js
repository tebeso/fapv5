window.FapSensor = class FapSensor {
    constructor() {

        let $this = this;
        setInterval(
            function () {
                let title = $('#fap-page-title').text().trim();

                if (title === 'TEMPERATURE' || title === 'SETUP TEMPERATURE' || title === 'CABIN STATUS') {
                    $this.getTemperatureState();
                }
            },
            500,
        );
    }


    getTemperatureState() {
        $.ajax({
            type:    'GET',
            url:     'temperature/get-state-assigned',
            success: function (message) {

                $.each(message, function (position, attributes) {
                    $('#temperature-'+position).text(attributes.state)
                });
            },
        });
    }
};