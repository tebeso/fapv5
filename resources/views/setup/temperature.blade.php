@extends('temperature')
<div style="position: absolute; top:0; left:0; z-index:100;">
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
        <div class="select-box" style="top: 248px; left: 810px;">
            <label for="320-fwd"></label>
            <select name="320-fwd" id="320-fwd" class="sensor-select" style="width: 150px;">
                <option></option>
                @foreach($sensors as $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|temp|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="select-box" style="top: 449px; left: 550px;">
            <label for="320-aft"></label>
            <select name="320-aft" id="320-aft" class="sensor-select" style="width: 150px;">
                <option></option>
                @foreach($sensors as $id => $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|temp|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>
    @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
        <div class="select-box" style="top: 195px; left: 810px;">
            <label for="346-zone-1"></label>
            <select name="346-zone-1" id="346-zone-1" class="sensor-select" style="width: 150px;">
                <option></option>
                @foreach($sensors as $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|temp|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="select-box" style="top: 285px; left: 550px;">
            <label for="346-zone-2"></label>
            <select name="346-zone-2" id="346-zone-2" class="sensor-select" style="width: 150px;">
                <option></option>
                @foreach($sensors as $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|temp|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="select-box" style="top: 375px; left: 810px;">
            <label for="346-zone-3"></label>
            <select name="346-zone-3" id="346-zone-3" class="sensor-select" style="width: 150px;">
                <option></option>
                @foreach($sensors as $id => $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|temp|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="select-box" style="top: 460px; left: 550px;">
            <label for="346-zone-4"></label>
            <select name="346-zone-4" id="346-zone-4" class="sensor-select" style="width: 150px;">
                <option></option>
                @foreach($sensors as $id => $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|temp|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>
