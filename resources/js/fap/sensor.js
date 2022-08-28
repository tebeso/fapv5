window.FapSensor = class FapSensor {
    loadEvents() {
        $('.sensor-select').on('change', function () {
            console.log('change');
            $.ajax({
                type: 'GET',
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
            data:    {type: type},
            success: function (message) {
                $.each(JSON.parse(message), function (position, sensor) {
                    $('#' + position).val(sensor);
                });
            },
        });
    }
};