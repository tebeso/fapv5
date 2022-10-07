@extends('general.aircraft')
@section('module')
    <div id="smoke-a346-1" class="smoke-detector" style="top:58px; left:16px;"></div>
    <div id="smoke-a346-2" class="smoke-detector" style="top:150px; left:10px;"></div>
    <div id="smoke-a346-3" class="smoke-detector" style="top:253px; left:10px;"></div>
    <div id="smoke-a346-4" class="smoke-detector" style="top:351px; left:10px;"></div>
    <div id="smoke-a346-5" class="smoke-detector" style="top:449px; left:16px;"></div>

    <div class="select-boxes" style="position: relative; left:-340px; top:-8px;">

        @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
        @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')

            <div class="select-box">
                <label for="346-zone-1"></label>
                <select name="346-zone-1" id="346-zone-1" class="sensor-select">
                    <option></option>
                    @foreach($sensors as $sensor)
                        <option value="{{ $sensor['sensor_id'] }}|smoke|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="select-box" style="top: 83px;">
                <label for="346-zone-2"></label>
                <select name="346-zone-2" id="346-zone-2" class="sensor-select">
                    <option></option>
                    @foreach($sensors as $sensor)
                        <option value="{{ $sensor['sensor_id'] }}|smoke|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="select-box" style="top: 176px;">
                <label for="346-zone-3"></label>
                <select name="346-zone-3" id="346-zone-3" class="sensor-select">
                    <option></option>
                    @foreach($sensors as $id => $sensor)
                        <option value="{{ $sensor['sensor_id'] }}|smoke|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="select-box" style="top: 264px;">
                <label for="346-zone-4"></label>
                <select name="346-zone-4" id="346-zone-4" class="sensor-select">
                    <option></option>
                    @foreach($sensors as $id => $sensor)
                        <option value="{{ $sensor['sensor_id'] }}|smoke|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="select-box" style="top: 352px;">
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
            $('.fap-aircraft').css('left', '440px');
            window.fapSensor.loadEvents();
            window.fapSensor.getAssignedSensors('smoke');
        });
    </script>
@endsection