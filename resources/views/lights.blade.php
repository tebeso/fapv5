@extends('general.aircraft')

@section('module')
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
        <div id="lights-320-346-fwd-entry" class="lights lights-entry"></div>
        <div id="lights-320-business" class="lights"></div>
        <div id="lights-320-economy" class="lights"></div>
        <div id="lights-320-346-aft-entry" class="lights lights-entry"></div>

        <div id="lights-320-business-label" class="lights-label black-text">C/CI</div>
        <div id="lights-320-economy-label" class="lights-label black-text">Y/CI</div>

        <div class="fap-content-box fap-box-small" id="button-320-346-fwd-entry"
             style="position: relative; top:-15px; left:-315px;">
            <div class="fap-box-title bold-text" style="font-size: 17px;">
                FWD ENTRY
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:70px; left:23px;">
                <div class="fap-button light-button">BRT</div>
                <div class="fap-button light-button">DIM 1</div>
                <div class="fap-button light-button">DIM 2</div>
            </div>
        </div>

        <div class="fap-content-box fap-box-small" id="button-320-business"
             style="position: relative; top:35px; left:-315px;">
            <div class="fap-box-title bold-text" style="font-size: 17px;">
                BUSINESS CLASS
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:70px; left:23px;">
                <div class="fap-button light-button">BRT</div>
                <div class="fap-button light-button">DIM 1</div>
                <div class="fap-button light-button">DIM 2</div>
            </div>
        </div>

        <div class="fap-content-box fap-box-small" id="button-320-economy"
             style="position: relative; top:85px; left:-315px;">
            <div class="fap-box-title bold-text" style="font-size: 17px;">
                ECONOMY CLASS
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:70px; left:23px;">
                <div class="fap-button light-button">BRT</div>
                <div class="fap-button light-button">DIM 1</div>
                <div class="fap-button light-button">DIM 2</div>
            </div>
        </div>

        <div class="fap-content-box fap-box-medium" style="position: relative; top:-420px; left:180px; width:400px;">
            <div class="fap-box-title bold-text" style="font-size: 17px;">
                GENERAL CABIN SETTINGS
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:70px; left:23px;">
                <div class="fap-button">BRT</div>
                <div class="fap-button">DIM 1</div>
                <div class="fap-button">DIM 2</div>
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:126px; left:23px;">
                <div class="fap-button light-button">BRT</div>
                <div class="fap-button light-button">DIM 1</div>
                <div class="fap-button light-button">DIM 2</div>
            </div>
        </div>

        <div class="fap-content-box fap-box-small" id="button-320-346-aft-entry"
             style="position: relative; top:-370px; left:180px;">
            <div class="fap-box-title bold-text" style="font-size: 17px;">
                AFT ENTRY
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:70px; left:23px;">
                <div class="fap-button light-button">BRT</div>
                <div class="fap-button light-button">DIM 1</div>
                <div class="fap-button light-button">DIM 2</div>
            </div>
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


        <div class="fap-content-box fap-box-small" id="button-320-346-fwd-entry"
             style="position: relative; top:-15px; left:-315px; height:90px">
            <div class="fap-box-title bold-text" style="font-size: 17px;">
                FWD ENTRY
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:36px; left:23px;">
                <div class="fap-button light-button">BRT</div>
                <div class="fap-button light-button">DIM 1</div>
                <div class="fap-button light-button">DIM 2</div>
            </div>
        </div>

        <div class="fap-content-box fap-box-small" id="button-346-first"
             style="position: relative; top:16px; left:-315px; height:90px">
            <div class="fap-box-title bold-text" style="font-size: 17px;">
                FIRST CLASS
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:36px; left:23px;">
                <div class="fap-button light-button">BRT</div>
                <div class="fap-button light-button">DIM 1</div>
                <div class="fap-button light-button">DIM 2</div>
            </div>
        </div>

        <div class="fap-content-box fap-box-small" id="button-346-business"
             style="position: relative; top:46px; left:-315px; height:90px">
            <div class="fap-box-title bold-text" style="font-size: 17px;">
                BUSINESS CLASS
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:36px; left:23px;">
                <div class="fap-button light-button">BRT</div>
                <div class="fap-button light-button">DIM 1</div>
                <div class="fap-button light-button">DIM 2</div>
            </div>
        </div>

        <div class="fap-content-box fap-box-small" id="button-346-fwd-economy"
             style="position: relative; top:76px; left:-315px; height:90px">
            <div class="fap-box-title bold-text" style="font-size: 17px;">
                ECONOMY CLASS
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:36px; left:23px;">
                <div class="fap-button light-button">BRT</div>
                <div class="fap-button light-button">DIM 1</div>
                <div class="fap-button light-button">DIM 2</div>
            </div>
        </div>

        <div class="fap-content-box fap-box-medium" style="position: relative; top:-420px; left:180px; width:400px;">
            <div class="fap-box-title bold-text" style="font-size: 17px;">
                GENERAL CABIN SETTINGS
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:70px; left:23px;">
                <div class="fap-button">BRT</div>
                <div class="fap-button">DIM 1</div>
                <div class="fap-button">DIM 2</div>
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:126px; left:23px;">
                <div class="fap-button light-button">BRT</div>
                <div class="fap-button light-button">DIM 1</div>
                <div class="fap-button light-button">DIM 2</div>
            </div>
        </div>

        <div class="fap-content-box fap-box-small" id="button-320-346-aft-entry"
             style="position: relative; top:-370px; left:410px; height:90px">
            <div class="fap-box-title bold-text" style="font-size: 17px;">
                AFT ENTRY
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:36px; left:23px;">
                <div class="fap-button light-button">BRT</div>
                <div class="fap-button light-button">DIM 1</div>
                <div class="fap-button light-button">DIM 2</div>
            </div>
        </div>

        <div class="fap-content-box fap-box-small" id="button-346-fwd-galley"
             style="position: relative; top:-470px; left:180px; height:90px">
            <div class="fap-box-title bold-text" style="font-size: 17px;">
                FWD GALLEY
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:36px; left:23px;">
                <div class="fap-button light-button">BRT</div>
                <div class="fap-button light-button">DIM 1</div>
                <div class="fap-button light-button">DIM 2</div>
            </div>
        </div>

        <div class="fap-content-box fap-box-small" id="button-346-aft-galley"
             style="position: relative; top:-440px; left:180px; height:90px">
            <div class="fap-box-title bold-text" style="font-size: 17px;">
                AFT GALLEY
            </div>
            <div class="fap-button-group-3-horizontal" style="position: absolute; top:36px; left:23px;">
                <div class="fap-button light-button">BRT</div>
                <div class="fap-button light-button">DIM 1</div>
                <div class="fap-button light-button">DIM 2</div>
            </div>
        </div>
    @else
        NO AIRCRAFT SELECTED
    @endif
@endsection

@section('module-js')
    <script>
        $('.fap-aircraft').css('left', '320px');
    </script>
@endsection