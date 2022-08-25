@extends('general.aircraft')
@section('module')
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
        <div class="temperature-block temperature-block-320">1</div>
        <div class="temperature-block temperature-block-320">2</div>
    @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
        <div id="temperature-346-zone-1" class="temperature-block temperature-block-346" style="top:80px;">23.0</div>
        <div id="temperature-346-zone-2" class="temperature-block temperature-block-346" style="top:90px;">24.0</div>
        <div id="temperature-346-zone-3" class="temperature-block temperature-block-346" style="top:100px;">25.0</div>
        <div id="temperature-346-zone-4" class="temperature-block temperature-block-346" style="top:110px;">24.0</div>

        <div class="temperature-select-box" style="top: -278px; left: 140px;">
            <label for="346-zone-1">Zone 1</label>
            <select name="346-zone-1" id="346-zone-1" class="sensor-select">
                <option></option>
                @foreach($sensors as $id => $sensor)
                    <option value="{{ $id }}|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="temperature-select-box" style="top: -191px; left: 140px;">
            <label for="346-zone-1">Zone 2</label>
            <select name="346-zone-1" id="346-zone-1" class="sensor-select">
                <option></option>
                @foreach($sensors as $id => $sensor)
                    <option value="{{ $id }}|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="temperature-select-box" style="top: -100px; left: 140px;">
            <label for="346-zone-1">Zone 3</label>
            <select name="346-zone-1" id="346-zone-1" class="sensor-select">
                <option></option>
                @foreach($sensors as $id => $sensor)
                    <option value="{{ $id }}|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="temperature-select-box" style="top: -13px; left: 140px;">
            <label for="346-zone-1">Zone 4</label>
            <select name="346-zone-1" id="346-zone-1" class="sensor-select">
                <option></option>
                @foreach($sensors as $id => $sensor)
                    <option value="{{ $id }}|{{ $sensor['hub'] }}">{{ $sensor['name'] }}</option>
                @endforeach
            </select>
        </div>
    @else
        NO AIRCRAFT SELECTED
    @endif

    <script>
        function getAssignedSensors() {
            $.ajax({
                type:    'GET',
                url:     'setup/temperature/get-assigned-temperature',
                success: function (message) {
                    console.log(message);
                    //$.each(JSON.parse(message), function (position, light) {
                    //$('#' + position).val(light);
                    //});
                },
                error:   function (message) {
                },
            });
        }

        $(document).ready(function () {
            $('.fap-aircraft').css('left', '275px');
            getAssignedSensors();
        });
    </script>
@endsection