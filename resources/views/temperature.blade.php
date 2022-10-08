@include('general.aircraft-temperature')

@if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
    <div id="fap-zone-switcher-box"
         style="position: absolute; top:80px; left:513px; width: 460px; height:550px;">
        <div class="fap-button fap-zone-switcher fap-button-active" style="top:100px; left:130px;"
             data-zone="Zone 1">Zone 1
        </div>
        <div class="fap-button fap-zone-switcher" style="top:215px; left:240px;" data-zone="Zone 2">Zone 2</div>
    </div>
@elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
    <div id="fap-zone-switcher-box"
         style="position: absolute; top:80px; left:513px; width: 460px; height:550px;">
        <div class="fap-button fap-zone-switcher fap-button-active" style="top:100px; left:130px;"
             data-zone="Zone 1">Zone 1
        </div>
        <div class="fap-button fap-zone-switcher" style="top:215px; left:240px;" data-zone="Zone 2">Zone 2</div>
        <div class="fap-button fap-zone-switcher" style="top:322px; left: 21px;" data-zone="Zone 3">Zone 3</div>
        <div class="fap-button fap-zone-switcher" style="top:435px; left:131px;" data-zone="Zone 4">Zone 4</div>
    </div>
@endif

<div style="left:250px; top:70px; width:276px; position: absolute;">
    <div class="fap-content-box fap-box-medium" style="top:20px; width:276px; height:360px;">
        <div class="fap-box-title">PLEASE WAIT</div>
        <div style="display:flex;">
            <div id="temperature-scale">
                <div class="pipe-top"></div>
                <div class="pipe bubble">
                    <div class="pipe-progress"></div>
                    <div class="white-line"></div>
                </div>
                <div class="ball bubble"></div>
                <div id="ball-temp" class="bold-text"
                     style="position: relative;top: -37px; left:70px;text-align: center; width:45px;">X.X°C
                </div>

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

                <div class="pipe-range" style="background-color:#BFE4E4">

                </div>
            </div>
            <div id="temperature-setter">
                <div class="bold-text" style="font-size: 13px; text-align: center; position: absolute; top:65px;">
                    SELECTED<br />TEMPERATURE
                </div>
                <div class="fap-display-box"
                     style="position: absolute; top:110px; left:185px; padding: 10px; width:40px; text-align: center;">
                    -
                </div>
                <div class="fap-button temperature-setter-button" data-mode="up" style="top:140px; left:17px;">
                    <div class="fap-arrow fap-up-arrow"></div>
                </div>
                <div class="fap-button temperature-setter-button" data-mode="down" style="top:195px; left: -38px;">
                    <div class="fap-arrow fap-down-arrow"></div>
                </div>
            </div>
        </div>
        <div class="fap-content-box fap-box-medium bold-text"
             style="top:400px; width:276px; height:125px; text-align: center; padding-top:15px; left:0;">
            <div class="fap-button fap-button-inactive" style="left:107px;">Reset</div>
            <div style="margin-top:5px;">
                RESET TO COCKPIT<br />SELECTED TEMPERATURE<br />(ALL AREAS)
            </div>
        </div>
    </div>
</div>

<script>
    $('.fap-aircraft').css('left', '663px');
</script>
