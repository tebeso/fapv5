@extends('lights')
<div style="position: absolute; top:0; left:0;">
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
        <div class="lights-select-box" style="top: 20px; left: 49px;">
            <label for="320-346-fwd-entry"></label>
            <select name="320-346-fwd-entry" id="320-346-fwd-entry" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 55px; left: 49px;">
            <label for="320-business"></label>
            <select name="320-business" id="320-business" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 215px; left: 49px;">
            <label for="320-economy"></label>
            <select name="320-economy" id="320-economy" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 345px; left: 49px;">
            <label for="320-346-aft-entry"></label>
            <select name="320-346-aft-entry" id="320-346-aft-entry" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

    @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
        <div class="lights-select-box" style="top: 192px; left: 49px;">
            <label for="320-346-fwd-entry"></label>
            <select name="320-346-fwd-entry" id="320-346-fwd-entry" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 337px; left: 49px;">
            <label for="346-first"></label>
            <select name="346-first" id="346-first" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 482px; left: 49px;">
            <label for="346-business"></label>
            <select name="346-business" id="346-business" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 627px; left: 49px;">
            <label for="346-fwd-economy"></label>
            <select name="346-fwd-economy" id="346-fwd-economy"
                    class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 342px; left: 545px;">
            <label for="346-rear-economy"></label>
            <select name="346-rear-economy" id="346-rear-economy" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 488px; left: 545px;">
            <label for="346-fwd-galley"></label>
            <select name="346-fwd-galley" id="346-fwd-galley" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 488px; left: 779px;">
            <label for="346-aft-galley"></label>
            <select name="346-aft-galley" id="346-aft-galley" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="lights-select-box" style="top: 632px; left: 545px;">
            <label for="320-346-aft-entry"></label>
            <select name="320-346-aft-entry" id="320-346-aft-entry" class="lights-select">
                <option></option>
                @foreach($lights as $light)
                    <option value="{{ $light['light_id'] }}|{{ $light['type'] }}">{{ $light['name'] }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>

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
        $('.fap-aircraft').css('left', '320px');
        getAssignedLights();
    });
</script>
