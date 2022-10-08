@extends('doors-slides')

<div style="position: absolute; top:0; left:0;">
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')

    @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')

        <div style="position: absolute; left: 142px; top:169px;">
            <label for="select-door-one-left"></label>
            <select name="select-door-one-left" id="select-door-one-left" class="door-select">
                <option></option>
                @foreach($doors as $door)
                    <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div style="position: absolute; left: 142px; top:275px;">
            <label for="select-door-two-left"></label>
            <select name="select-door-two-left" id="select-door-two-left" class="door-select">
                <option></option>
                @foreach($doors as $door)
                    <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div style="position: absolute; left: 142px; top:388px;">
            <label for="select-door-three-left"></label>
            <select name="select-door-three-left" id="select-door-three-left" class="door-select">
                <option></option>
                @foreach($doors as $door)
                    <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div style="position: absolute; left: 142px; top:499px;">
            <label for="select-door-four-left"></label>
            <select name="select-door-four-left" id="select-door-four-left" class="door-select">
                <option></option>
                @foreach($doors as $door)
                    <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div style="position: absolute; left: 142px; top:609px;">
            <label for="select-door-five-left"></label>
            <select name="select-door-five-left" id="select-door-five-left" class="door-select">
                <option></option>
                @foreach($doors as $door)
                    <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div style="position: absolute; left:552px; top:169px;">
            <label for="select-door-one-right"></label>
            <select name="select-door-one-right" id="select-door-one-right" class="door-select">
                <option></option>
                @foreach($doors as $door)
                    <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div style="position: absolute;  left:552px;top:275px;">
            <label for="select-door-two-right"></label>
            <select name="select-door-two-right" id="select-door-two-right" class="door-select">
                <option></option>
                @foreach($doors as $door)
                    <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div style="position: absolute;  left:552px;top:388px;">
            <label for="select-door-three-right"></label>
            <select name="select-door-three-right" id="select-door-three-right" class="door-select">
                <option></option>
                @foreach($doors as $door)
                    <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div style="position: absolute;  left:552px;top:499px;">
            <label for="select-door-four-right"></label>
            <select name="select-door-four-right" id="select-door-four-right" class="door-select">
                <option></option>
                @foreach($doors as $door)
                    <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div style="position: absolute;  left:552px;top:609px;">
            <label for="select-door-five-right"></label>
            <select name="select-door-five-right" id="select-door-five-right" class="door-select">
                <option></option>
                @foreach($doors as $door)
                    <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>

<script>
    $('.fap-aircraft').css('left', '420px');

    $('.door-select').on('change', function () {
        $.ajax({
            type:    'GET',
            url:     'setup/sensors/assign',
            data:    {id: $(this).attr('id'), selectedValue: $(this).children('option:selected').val()},
            success: function (message) {
            },
            error:   function (message) {
            },
        });
    });

    $(document).ready(function () {
        window.fapSensor.loadEvents();
        window.fapSensor.getAssignedSensors('door');
    });
</script>
