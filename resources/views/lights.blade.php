@include('general.aircraft-lights')

@if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
    <div class="fap-content-box fap-box-small" id="button-320-346-fwd-entry"
         style="position: relative; top:-15px; left:-315px;">
        <div class="fap-box-title bold-text" style="font-size: 17px;">
            FWD ENTRY
        </div>
        <div class="fap-button-group-3-horizontal" style="top:70px; left:23px;">
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
        <div class="fap-button-group-3-horizontal" style="top:70px; left:23px;">
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
        <div class="fap-button-group-3-horizontal" style="top:70px; left:23px;">
            <div class="fap-button light-button">BRT</div>
            <div class="fap-button light-button">DIM 1</div>
            <div class="fap-button light-button">DIM 2</div>
        </div>
    </div>

    <div class="fap-content-box fap-box-medium"
         style="position: relative; top:-420px; left:180px; width:400px; height:130px;">
        <div class="fap-box-title bold-text" style="font-size: 17px;">
            GENERAL CABIN SETTINGS
        </div>
        <div class="fap-button-group-3-horizontal" style="left:23px;">
            <div class="fap-button">BRT</div>
            <div class="fap-button">DIM 1</div>
            <div class="fap-button">DIM 2</div>
        </div>
        <div class="fap-button-group-3-horizontal" style="top:77px; left:23px;">
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
        <div class="fap-button-group-3-horizontal" style="top:70px; left:23px;">
            <div class="fap-button light-button">BRT</div>
            <div class="fap-button light-button">DIM 1</div>
            <div class="fap-button light-button">DIM 2</div>
        </div>
    </div>
@elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
    <div class="fap-content-box fap-box-small" id="button-320-346-fwd-entry"
         style="top:90px; height:90px">
        <div class="fap-box-title bold-text" style="font-size: 17px;">
            FWD ENTRY
        </div>
        <div class="fap-button-group-3-horizontal" style="top:36px; left:23px;">
            <div class="fap-button light-button">BRT</div>
            <div class="fap-button light-button">DIM 1</div>
            <div class="fap-button light-button">DIM 2</div>
        </div>
    </div>

    <div class="fap-content-box fap-box-small" id="button-346-first"
         style="top:235px; height:90px">
        <div class="fap-box-title bold-text" style="font-size: 17px;">
            FIRST CLASS
        </div>
        <div class="fap-button-group-3-horizontal" style="top:36px; left:23px;">
            <div class="fap-button light-button">BRT</div>
            <div class="fap-button light-button">DIM 1</div>
            <div class="fap-button light-button">DIM 2</div>
        </div>
    </div>

    <div class="fap-content-box fap-box-small" id="button-346-business"
         style="top:380px; height:90px">
        <div class="fap-box-title bold-text" style="font-size: 17px;">
            BUSINESS CLASS
        </div>
        <div class="fap-button-group-3-horizontal" style="top:36px; left:23px;">
            <div class="fap-button light-button">BRT</div>
            <div class="fap-button light-button">DIM 1</div>
            <div class="fap-button light-button">DIM 2</div>
        </div>
    </div>

    <div class="fap-content-box fap-box-small" id="button-346-fwd-economy"
         style="top:525px; height:90px">
        <div class="fap-box-title bold-text" style="font-size: 17px;">
            FWD ECONOMY CLASS
        </div>
        <div class="fap-button-group-3-horizontal" style="top:36px; left:23px;">
            <div class="fap-button light-button">BRT</div>
            <div class="fap-button light-button">DIM 1</div>
            <div class="fap-button light-button">DIM 2</div>
        </div>
    </div>

    <div class="fap-content-box fap-box-medium"
         style="top: 90px; left: 545px; width:400px; height:130px;">
        <div class="fap-box-title bold-text" style="font-size: 17px;">
            GENERAL CABIN SETTINGS
        </div>
        <div class="fap-button-group-3-horizontal" style="left:23px;">
            <div class="fap-button">BRT</div>
            <div class="fap-button">DIM 1</div>
            <div class="fap-button">DIM 2</div>
        </div>
        <div class="fap-button-group-3-horizontal" style="top:77px; left:23px;">
            <div class="fap-button light-button">BRT</div>
            <div class="fap-button light-button">DIM 1</div>
            <div class="fap-button light-button">DIM 2</div>
        </div>
    </div>


    <div class="fap-content-box fap-box-small" id="button-346-rear-economy"
         style="top:240px; left:545px; height:90px">
        <div class="fap-box-title bold-text" style="font-size: 17px;">
            AFT ECONOMY CLASS
        </div>
        <div class="fap-button-group-3-horizontal" style="top:36px; left:23px;">
            <div class="fap-button light-button">BRT</div>
            <div class="fap-button light-button">DIM 1</div>
            <div class="fap-button light-button">DIM 2</div>
        </div>
    </div>


    <div class="fap-content-box fap-box-small" id="button-346-fwd-galley"
         style="top:385px; left:545px; height:90px">
        <div class="fap-box-title bold-text" style="font-size: 17px;">
            FWD GALLEY
        </div>
        <div class="fap-button-group-3-horizontal" style="top:36px; left:23px;">
            <div class="fap-button light-button">BRT</div>
            <div class="fap-button light-button">DIM 1</div>
            <div class="fap-button light-button">DIM 2</div>
        </div>
    </div>

    <div class="fap-content-box fap-box-small" id="button-346-aft-galley"
         style="top:385px; left:780px; height:90px">
        <div class="fap-box-title bold-text" style="font-size: 17px;">
            AFT GALLEY
        </div>
        <div class="fap-button-group-3-horizontal" style="top:36px; left:23px;">
            <div class="fap-button light-button">BRT</div>
            <div class="fap-button light-button">DIM 1</div>
            <div class="fap-button light-button">DIM 2</div>
        </div>
    </div>

    <div class="fap-content-box fap-box-small" id="button-320-346-aft-entry"
         style="top:530px; left:545px; height:90px">
        <div class="fap-box-title bold-text" style="font-size: 17px;">
            AFT ENTRY
        </div>
        <div class="fap-button-group-3-horizontal" style="top:36px; left:23px;">
            <div class="fap-button light-button">BRT</div>
            <div class="fap-button light-button">DIM 1</div>
            <div class="fap-button light-button">DIM 2</div>
        </div>
    </div>
@endif

<script>
    $('.fap-aircraft').css('left', '320px');
</script>
