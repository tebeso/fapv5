@extends('general.aircraft')

@section('module')
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')

    @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
        <div id="door-label">
            <div id="label-door-one-left" class="door-left-label" style="top:72px;">
                <div class="slides-disarmed slides-disarmed-left">
                    <select name="select-door-one-left" id="select-door-one-left" class="door-select">
                        <option></option>
                        @foreach($doors as $door)
                            <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                1L
            </div>
            <div id="label-door-two-left" class="door-left-label" style="top:158px;">
                <div class="slides-disarmed slides-disarmed-left">
                    <select name="select-door-two-left" id="select-door-two-left" class="door-select">
                        <option></option>
                        @foreach($doors as $door)
                            <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                2L
            </div>
            <div id="label-door-three-left" class="door-left-label" style="top:251px;">
                <div class="slides-disarmed slides-disarmed-left">
                    <select name="select-door-three-left" id="select-door-three-left" class="door-select">
                        <option></option>
                        @foreach($doors as $door)
                            <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                3L
            </div>
            <div id="label-door-four-left" class="door-left-label" style="top:342px;">
                <div class="slides-disarmed slides-disarmed-left">
                    <select name="select-door-four-left" id="select-door-four-left" class="door-select">
                        <option></option>
                        @foreach($doors as $door)
                            <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                4L
            </div>
            <div id="label-door-five-left" class="door-left-label" style="top:432px;">
                <div class="slides-disarmed slides-disarmed-left">
                    <select name="select-door-five-left" id="select-door-five-left" class="door-select">
                        <option></option>
                        @foreach($doors as $door)
                            <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                5L
            </div>

            <div id="label-door-one-right" class="door-right-label" style="top:-26px;">
                <div class="slides-disarmed slides-disarmed-right">
                    <select name="select-door-one-right" id="select-door-one-right" class="door-select">
                        <option></option>
                        @foreach($doors as $door)
                            <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                1R
            </div>
            <div id="label-door-two-right" class="door-right-label" style="top:59px;">
                <div class="slides-disarmed slides-disarmed-right">
                    <select name="select-door-two-right" id="select-door-two-right" class="door-select">
                        <option></option>
                        @foreach($doors as $door)
                            <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                2R
            </div>
            <div id="label-door-three-right" class="door-right-label" style="top:153px;">
                <div class="slides-disarmed slides-disarmed-right">
                    <select name="select-door-three-right" id="select-door-three-right" class="door-select">
                        <option></option>
                        @foreach($doors as $door)
                            <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                3R
            </div>
            <div id="label-door-four-right" class="door-right-label" style="top:244px;">
                <div class="slides-disarmed slides-disarmed-right">
                    <select name="select-door-four-right" id="select-door-four-right" class="door-select">
                        <option></option>
                        @foreach($doors as $door)
                            <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                4R
            </div>
            <div id="label-door-five-right" class="door-right-label" style="top:333px;">
                <div class="slides-disarmed slides-disarmed-right">
                    <select name="select-door-five-right" id="select-door-five-right" class="door-select">
                        <option></option>
                        @foreach($doors as $door)
                            <option value="{{ $door['sensor_id'] }}|door|raspbee">{{ $door['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                5R
            </div>
        </div>
    @endif
@endsection

@section('module-js')
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
@endsection
