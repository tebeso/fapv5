window.FapSensor = class FapSensor {
    loadEvents() {
        $('.sensor-select').on('change', function () {
            $.ajax({
                type: 'GET',
                timeout: 3000,
                url:  'setup/sensors/assign',
                data: {
                    id:            $(this).attr('id'),
                    selectedValue: $(this).children('option:selected').val(),
                },
            });
        });
    }

    getAssignedSensors(type) {
        $.ajax({
            type:    'GET',
            url:     'setup/sensors/get-assigned-sensors',
            timeout: 3000,
            data:    {type: type},
            success: function (message) {
                $.each(JSON.parse(message), function (position, sensor) {
                    $('#' + position).val(sensor);
                });
            },
        });
    }
};