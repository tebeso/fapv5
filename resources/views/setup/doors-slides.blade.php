@extends('general.aircraft')

@section('module')
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')

    @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
        <div id="door-label">
            <div id="label-door-one-left" class="door-left-label" style="top:72px;">
                <div class="slides-disarmed slides-disarmed-left">SLIDE DISARMED</div>
                1L
            </div>
            <div id="label-door-two-left" class="door-left-label" style="top:158px;">
                <div class="slides-disarmed slides-disarmed-left">SLIDE DISARMED</div>
                2L
            </div>
            <div id="label-door-three-left" class="door-left-label" style="top:251px;">
                <div class="slides-disarmed slides-disarmed-left">SLIDE DISARMED</div>
                3L
            </div>
            <div id="label-door-four-left" class="door-left-label" style="top:342px;">
                <div class="slides-disarmed slides-disarmed-left">SLIDE DISARMED</div>
                4L
            </div>
            <div id="label-door-five-left" class="door-left-label" style="top:432px;">
                <div class="slides-disarmed slides-disarmed-left">SLIDE DISARMED</div>
                5L
            </div>

            <div id="label-door-one-right" class="door-right-label" style="top:-26px;">
                <div class="slides-disarmed slides-disarmed-right">SLIDE DISARMED</div>
                1R
            </div>
            <div id="label-door-two-right" class="door-right-label" style="top:59px;">
                <div class="slides-disarmed slides-disarmed-right">SLIDE DISARMED</div>
                2R
            </div>
            <div id="label-door-three-right" class="door-right-label" style="top:153px;">
                <div class="slides-disarmed slides-disarmed-right">SLIDE DISARMED</div>
                3R
            </div>
            <div id="label-door-four-right" class="door-right-label" style="top:244px;">
                <div class="slides-disarmed slides-disarmed-right">SLIDE DISARMED</div>
                4R
            </div>
            <div id="label-door-five-right" class="door-right-label" style="top:333px;">
                <div class="slides-disarmed slides-disarmed-right">SLIDE DISARMED</div>
                5R
            </div>
        </div>
    @else
        NO AIRCRAFT SELECTED
    @endif
@endsection

@section('module-js')
    <script>
        $('.fap-aircraft').css('left', '420px');

        function getAssignedSensors() {

        }

        $(document).ready(function () {
            getAssignedSensors();
        });
    </script>
@endsection
