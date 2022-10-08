@extends('smoke-detection')
<div class="select-boxes" style="position: absolute; left:0px; top:0px;">
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
    @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')

        <div class="select-box" style="top:140px; left:650px;">
            <label for="346-zone-1"></label>
            <select name="346-zone-1" id="346-zone-1" class="sensor-select">
                <option></option>
                @foreach($sensors as $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|smoke|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="select-box" style="top: 225px;left:650px;">
            <label for="346-zone-2"></label>
            <select name="346-zone-2" id="346-zone-2" class="sensor-select">
                <option></option>
                @foreach($sensors as $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|smoke|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="select-box" style="top: 320px;left:650px;">
            <label for="346-zone-3"></label>
            <select name="346-zone-3" id="346-zone-3" class="sensor-select">
                <option></option>
                @foreach($sensors as $id => $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|smoke|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="select-box" style="top: 410px;left:650px;">
            <label for="346-zone-4"></label>
            <select name="346-zone-4" id="346-zone-4" class="sensor-select">
                <option></option>
                @foreach($sensors as $id => $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|smoke|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="select-box" style="top: 495px;left:650px;">
            <label for="346-zone-5"></label>
            <select name="346-zone-5" id="346-zone-5" class="sensor-select">
                <option></option>
                @foreach($sensors as $id => $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|smoke|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>


<script>
    $(document).ready(function () {
        $('.fap-aircraft').css('left', '425px');
        window.fapSensor.loadEvents();
        window.fapSensor.getAssignedSensors('smoke');
    });
</script>
