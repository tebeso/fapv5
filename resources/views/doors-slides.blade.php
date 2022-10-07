@extends('general.aircraft')

@section('module')
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')

    @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
        <div id="door-label">
            <div id="label-door-one-left" class="door-left-label" style="top:72px;">
                <div class="slides-disarmed slides-disarmed-left yellow-text">SLIDE DISARMED</div>
                1L
            </div>
            <div id="label-door-two-left" class="door-left-label" style="top:158px;">
                <div class="slides-disarmed slides-disarmed-left yellow-text">SLIDE DISARMED</div>
                2L
            </div>
            <div id="label-door-three-left" class="door-left-label" style="top:251px;">
                <div class="slides-disarmed slides-disarmed-left yellow-text">SLIDE DISARMED</div>
                3L
            </div>
            <div id="label-door-four-left" class="door-left-label" style="top:342px;">
                <div class="slides-disarmed slides-disarmed-left yellow-text">SLIDE DISARMED</div>
                4L
            </div>
            <div id="label-door-five-left" class="door-left-label" style="top:432px;">
                <div class="slides-disarmed slides-disarmed-left yellow-text">SLIDE DISARMED</div>
                5L
            </div>

            <div id="label-door-one-right" class="door-right-label" style="top:-26px;">
                <div class="slides-disarmed slides-disarmed-right yellow-text">SLIDE DISARMED</div>
                1R
            </div>
            <div id="label-door-two-right" class="door-right-label" style="top:59px;">
                <div class="slides-disarmed slides-disarmed-right yellow-text">SLIDE DISARMED</div>
                2R
            </div>
            <div id="label-door-three-right" class="door-right-label" style="top:153px;">
                <div class="slides-disarmed slides-disarmed-right yellow-text">SLIDE DISARMED</div>
                3R
            </div>
            <div id="label-door-four-right" class="door-right-label" style="top:244px;">
                <div class="slides-disarmed slides-disarmed-right yellow-text">SLIDE DISARMED</div>
                4R
            </div>
            <div id="label-door-five-right" class="door-right-label" style="top:333px;">
                <div class="slides-disarmed slides-disarmed-right yellow-text">SLIDE DISARMED</div>
                5R
            </div>
        </div>

        <div class="open-doors">
            <div id="door-one-left-open" class="door door-generic door-open door-one-open door-left-open-front-aft"></div>
            <div id="door-two-left-open" class="door door-generic door-open door-two-open door-left-open"></div>
            <div id="door-three-left-open" class="door door-overwing door-open door-three-open door-left-open"></div>
            <div id="door-four-left-open" class="door door-generic door-open door-four-open door-left-open"></div>
            <div id="door-five-left-open" class="door door-generic door-open door-five-open door-left-open-front-aft"></div>
            <div id="door-one-right-open" class="door door-generic door-open door-one-open door-right-open-front-aft"></div>
            <div id="door-two-right-open" class="door door-generic door-open door-two-open door-right-open"></div>
            <div id="door-three-right-open" class="door door-overwing door-open door-three-open door-right-open"></div>
            <div id="door-four-right-open" class="door door-generic door-open door-four-open door-right-open"></div>
            <div id="door-five-right-open" class="door door-generic door-open door-five-open door-right-open-front-aft"></div>
        </div>
    @else
        NO AIRCRAFT SELECTED
    @endif

    <div id="fap-door-legend" class="fap-content-box">
        <div class="fap-box-title" style="font-size: 17px !important;">LEGEND</div>
        <div class="fap-door-legend-row">
            <div class="door door-generic green-bg" style="float:left;"></div>
            <div class="fap-door-legend-label">DOOR CLOSED &amp; ARMED</div>
        </div>
        <div class="fap-door-legend-row">
            <div class="door door-generic red-bg" style="float:left;"></div>
            <div class="fap-door-legend-label">DOOR OPEN</div>
        </div>
    </div>
@endsection

@section('module-js')
    <script>
        $('.fap-aircraft').css('left', '325px');
        $('.door').addClass('yellow-bg');

        function getAssignedSensors() {

        }

        $(document).ready(function () {
            getAssignedSensors();
        });
    </script>
@endsection
