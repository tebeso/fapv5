<div class="aircraft-module-doors">
    @include('general.aircraft-doors-slides')

    <div id="door-label" style="position: absolute; top:80px; left:370px;">

        @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')

        @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
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
        @endif
    </div>

    <div id="fap-door-legend" class="fap-content-box">
        <div class="fap-box-title" style="font-size: 17px !important;">LEGEND</div>
        <div class="fap-door-legend-row">
            <div class="door door-generic green-bg" style="float:left; background-color: #68B13C !important;"></div>
            <div class="fap-door-legend-label">DOOR CLOSED &amp; ARMED</div>
        </div>
        <div class="fap-door-legend-row">
            <div class="door door-generic red-bg" style="float:left;"></div>
            <div class="fap-door-legend-label">DOOR OPEN</div>
        </div>
    </div>

    <script>
        $('.fap-aircraft').css('left', '320px');
        $('.door').addClass('yellow-bg');
    </script>
</div>
