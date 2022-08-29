<div class="fap-content-box fap-box-medium" style="top: 140px; left:290px;">

    <div style="margin-top: 10px; margin-left:10px;">
        <div style="width:300px; position: relative;">
            Philips Hue Bridge
            <div id="hue-bridge-status" class="bold-text">please wait</div>
        </div>
        <div class="fap-button-group-3-horizontal" style="width:110px; position:relative; left:315px; top:-40px; ">
            <div class="fap-button fap-button-function" onclick="window.fapAdmin.pairBridge('hue');">Pair<br />Bridge
            </div>
            <div class="fap-button fap-button-function" onclick="window.fapAdmin.deleteBridge('hue');">Delete<br />Bridge
            </div>
        </div>

        <div style="position: relative; top:-40px">
            Pairing-Instructions
            <ul>
                <li>Click "Pair Bridge"</li>
                <li>Click on the Button of your Hue Bridge within 60 seconds</li>
            </ul>
        </div>
    </div>

</div>

<div class="fap-content-box fap-box-medium" style="top: 380px; left:290px;">
    <div style="margin-top:10px; margin-left: 10px;">
        <div style="width: 50%;">
            FAP Bridge
            <div id="raspbee-bridge-status" class="bold-text">please wait</div>
        </div>
        <div class="fap-button-group-3-horizontal" style="width:110px; position:relative; left:315px; top:-40px; ">
            <div class="fap-button fap-button-function" onclick="window.fapAdmin.pairBridge('raspbee');">Pair<br />Bridge
            </div>
            <div class="fap-button fap-button-function" onclick="window.fapAdmin.deleteBridge('raspbee');">Delete<br />Bridge
            </div>
        </div>
    </div>

    <div style="position: relative; top:-40px">
        Pairing-Instructions
        <ul>
            <li>Login to http://{{$serverIp}} on another device and click on Gateway</li>
            <li>Click on "Advanced" at the bottom</li>
            <li>Click "Pair Bridge"</li>
            <li>Click on the Button of your Hue Bridge within 60 seconds</li>
        </ul>
    </div>
</div>