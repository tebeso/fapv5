@extends('general.aircraft')
@section('module')
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
        <div id="temperature-320-zone-1" data-zone="FWD" class="temperature-block temperature-block-320"
             style="top:80px;">X.X
        </div>
        <div id="temperature-320-zone-2" data-zone="AFT" class="temperature-block temperature-block-320"
             style="top:110px;">X.X
        </div>
    @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
        <div id="temperature-346-zone-1" data-zone="1" class="temperature-block temperature-block-346"
             style="top:80px;">X.X
        </div>
        <div id="temperature-346-zone-2" data-zone="2" class="temperature-block temperature-block-346"
             style="top:90px;">X.X
        </div>
        <div id="temperature-346-zone-3" data-zone="3" class="temperature-block temperature-block-346"
             style="top:100px;">X.X
        </div>
        <div id="temperature-346-zone-4" data-zone="4" class="temperature-block temperature-block-346"
             style="top:110px;">X.X
        </div>

        <div id="fap-zone-switcher-box"
             style="position: relative; top:-400px; left:-200px; width: 460px; height:550px;">
            <div class="fap-button fap-zone-switcher" style="top:100px; left:130px;" data-zone="1">Zone 1</div>
            <div class="fap-button fap-zone-switcher" style="top:215px; left:240px;" data-zone="2">Zone 2</div>
            <div class="fap-button fap-zone-switcher" style="top:322px; left: 21px;" data-zone="3">Zone 3</div>
            <div class="fap-button fap-zone-switcher" style="top:435px; left:131px;" data-zone="4">Zone 4</div>
        </div>
    @else
        NO AIRCRAFT SELECTED
    @endif
    <div style="left:-522px; width:276px; top:0; position: absolute;">
        <div class="fap-content-box fap-box-medium" style="top:20px; width:276px; height:360px;">
            <div class="fap-box-title">FWD</div>
            <div style="display:flex;">
                <div id="temperature-scale">
                    <div class="pipe-top"></div>
                    <div class="pipe bubble temp-test">
                        <div class="white-line"></div>
                    </div>
                    <div class="ball bubble"></div>

                    <div class="pipe-scale">
                        <div>30 -</div>
                        <div style="top:30px;">28 -</div>
                        <div style="top:60px;">26 -</div>
                        <div style="top:90px;">24 -</div>
                        <div style="top:120px;">22 -</div>
                        <div style="top:150px;">20 -</div>
                        <div style="top:180px;">18 -</div>
                        <div style="top:210px;">16 -</div>
                    </div>
                </div>
                <div id="temperature-setter">
                    <div class="bold-text" style="font-size: 13px; text-align: center; position: absolute; top:65px;">
                        SELECTED<br />TEMPERATURE
                    </div>
                    <div class="fap-display-box" style="position: absolute; top:110px; left:185px; padding: 10px;">
                        23.0°C
                    </div>
                    <div class="fap-button" style="top:140px; left:17px;">
                        <div class="fap-arrow fap-up-arrow"></div>
                    </div>
                    <div class="fap-button" style="top:195px; left: -38px;">
                        <div class="fap-arrow fap-down-arrow"></div>
                    </div>
                </div>
            </div>
            <div class="fap-content-box fap-box-medium bold-text"
                 style="top:420px; width:276px; height:125px; text-align: center; padding-top:15px;">
                <div class="fap-button" style="left:107px;">Reset</div>
                <div style="margin-top:5px;">
                    RESET TO COCKPIT<br />SELECTED TEMPERATURE<br />(ALL AREAS)
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.fap-aircraft').css('left', '663px');

        zoneSwitcher = $('.fap-zone-switcher');

        function getAssignedSensors() {
            $.ajax({
                type:    'GET',
                url:     'setup/sensors/get-assigned-sensors',
                data:    {type: 'temp'},
                success: function (message) {
                    $.each(JSON.parse(message), function (position, sensor) {
                        $('#' + position).val(sensor);
                    });

                    loadTempScale();
                },
            });
        }

        function loadTempScale() {
            let activeZoneButton = $('#fap-zone-switcher-box').find('.fap-button-active');
            let activeZone       = activeZoneButton.data('zone');
            let activeZoneTemp   = $('.temperature-block[data-zone=' + activeZone + ']').text();

            console.log(activeZoneTemp);
        }

        getAssignedSensors();

        $(document).ready(function () {
            $(document).on('click', '.fap-zone-switcher', function () {
                $('#fap-zone-switcher-box').find('.fap-button-active').removeClass('fap-button-active');
                $(this).addClass('fap-button-active');
                loadTempScale();
            });

            zoneSwitcher.first().addClass('fap-button-active');
        });
    </script>
@endsection