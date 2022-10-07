@extends('general.aircraft')
@section('module')
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
        <div id="lights-320-346-fwd-entry" class="lights lights-entry"></div>
        <div id="lights-320-business" class="lights"></div>
        <div id="lights-320-economy" class="lights"></div>
        <div id="lights-320-346-aft-entry" class="lights lights-entry"></div>

        <div id="lights-320-business-label" class="lights-label black-text">C/CI</div>
        <div id="lights-320-economy-label" class="lights-label black-text">Y/CI</div>

        <div class="lights-select-box" style="top: 20px; left: 140px;">
            <label for="320-346-fwd-entry">Forward Entry</label>
            <select name="320-346-fwd-entry" id="320-346-fwd-entry" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 55px; left: 140px;">
            <label for="320-business">Business Class</label>
            <select name="320-business" id="320-business" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 215px; left: 140px;">
            <label for="320-economy">Economy</label>
            <select name="320-economy" id="320-economy" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>



        <div class="lights-select-box" style="top: 345px; left: 140px;">
            <label for="320-346-aft-entry">Forward Entry</label>
            <select name="320-346-aft-entry" id="320-346-aft-entry" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

    @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
        <div id="lights-320-346-fwd-entry" class="lights lights-entry"></div>
        <div id="lights-346-first" class="lights"></div>
        <div id="lights-346-fwd-galley" class="lights lights-entry"></div>
        <div id="lights-346-business" class="lights"></div>
        <div id="lights-346-fwd-economy" class="lights"></div>
        <div id="lights-346-aft-galley" class="lights lights-entry"></div>
        <div id="lights-346-rear-economy" class="lights"></div>
        <div id="lights-320-346-aft-entry" class="lights lights-entry"></div>

        <div id="lights-346-first-label" class="lights-label black-text">F/CI</div>
        <div id="lights-346-business-label" class="lights-label black-text">C/CI</div>
        <div id="lights-346-economy-label" class="lights-label black-text">Y/CI</div>

        <div class="lights-select-box" style="top: 10px; left: 140px;">
            <label for="320-346-fwd-entry">Forward Entry</label>
            <select name="320-346-fwd-entry" id="320-346-fwd-entry" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 22px; left: 140px;">
            <label for="346-first">First Class</label>
            <select name="346-first" id="346-first" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 33px; left: 140px;">
            <label for="346-fwd-galley">Forward Galley</label>
            <select name="346-fwd-galley" id="346-fwd-galley" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 65px; left: 140px;">
            <label for="346-business">Business Class</label>
            <select name="346-business" id="346-business" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 120px; left: 140px;">
            <label for="346-fwd-economy">Economy Front</label>
            <select name="346-fwd-economy" id="346-fwd-economy" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 149px; left: 140px;">
            <label for="346-aft-galley">Rear Galley</label>
            <select name="346-aft-galley" id="346-aft-galley" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 167px; left: 140px;">
            <label for="346-rear-economy">Economy Back</label>
            <select name="346-rear-economy" id="346-rear-economy" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="lights-select-box" style="top: 183px; left: 140px;">
            <label for="320-346-aft-entry">Aft Entry</label>
            <select name="320-346-aft-entry" id="320-346-aft-entry" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>
    @endif

    <script>
        $('.lights-select').on('change', function () {
            $.ajax({
                type:    'GET',
                url:     'setup/lights/assign',
                data:    {id: $(this).attr('id'), selectedValue: $(this).children('option:selected').val()},
                success: function (message) {
                },
                error:   function (message) {
                },
            });
        });

        function getAssignedLights() {
            $.ajax({
                type:    'GET',
                url:     'setup/lights/get-assigned-lights',
                success: function (message) {
                    $.each(JSON.parse(message), function (position, light) {
                        $('#' + position).val(light);
                    });
                },
                error:   function (message) {
                },
            });
        }

        $(document).ready(function () {
            $('.fap-aircraft').css('left','275px');
            getAssignedLights();
        });
    </script>
@endsection