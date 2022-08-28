@extends('general.aircraft')
@section('module')
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
        <div id="temperature-320-zone-1" class="temperature-block temperature-block-320" style="top:80px;">X.X</div>
        <div id="temperature-320-zone-2" class="temperature-block temperature-block-320" style="top:110px;">X.X</div>
    @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
        <div id="temperature-346-zone-1" class="temperature-block temperature-block-346" style="top:80px;">X.X</div>
        <div id="temperature-346-zone-2" class="temperature-block temperature-block-346" style="top:90px;">X.X</div>
        <div id="temperature-346-zone-3" class="temperature-block temperature-block-346" style="top:100px;">X.X</div>
        <div id="temperature-346-zone-4" class="temperature-block temperature-block-346" style="top:110px;">X.X</div>

        <div class="temperature-select-box" style="top: -278px; left: 140px;">
            <label for="346-zone-1"></label>
            <select name="346-zone-1" id="346-zone-1" class="sensor-select">
                <option></option>
                @foreach($sensors as $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|temp|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="temperature-select-box" style="top: -191px; left: 140px;">
            <label for="346-zone-2"></label>
            <select name="346-zone-2" id="346-zone-2" class="sensor-select">
                <option></option>
                @foreach($sensors as $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|temp|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="temperature-select-box" style="top: -100px; left: 140px;">
            <label for="346-zone-3"></label>
            <select name="346-zone-3" id="346-zone-3" class="sensor-select">
                <option></option>
                @foreach($sensors as $id => $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|temp|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="temperature-select-box" style="top: -13px; left: 140px;">
            <label for="346-zone-4"></label>
            <select name="346-zone-4" id="346-zone-4" class="sensor-select">
                <option></option>
                @foreach($sensors as $id => $sensor)
                    <option value="{{ $sensor['sensor_id'] }}|temp|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>
    @else
        NO AIRCRAFT SELECTED
    @endif

    <script>
        $(document).ready(function () {
            $('.fap-aircraft').css('left', '275px');

            window.fapSensor.loadEvents();
            window.fapSensor.getAssignedSensors('temp');
        });
    </script>
@endsection