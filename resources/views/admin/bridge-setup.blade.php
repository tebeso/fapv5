<div class="fap-content-box fap-box-medium" style="top: 140px; left:290px; height:210px;">

    <div style="margin-top: 10px; margin-left:10px;">
        <div style="width:300px; position: relative;">
            <b>Philips Hue Bridge</b>
            <div id="hue-bridge-status" class="bold-text">please wait</div>
        </div>
        <div class="fap-button-group-3-horizontal" style="width:110px; position:relative; left:315px; top:-45px; ">
            <div class="fap-button fap-button-function" onclick="window.fapAdmin.pairBridge('hue');">Pair<br />Bridge
            </div>
            <div class="fap-button fap-button-function" onclick="window.fapAdmin.deleteBridge('hue');">Delete<br />Bridge
            </div>
        </div>

        <div style="position: relative; top:-40px">
            <u>Bridge-Pairing-Instructions</u>
            <ul>
                <li>Click "Pair Bridge"</li>
                <li>Click on the Button of your Hue Bridge within 60 seconds</li>
            </ul>
        </div>

        <div style="position: relative; top:-40px">
            <u>Device-Pairing-Instructions</u>
            <ul>
                <li>Use the Philips Hue App to pair devices.</li>
            </ul>
        </div>
    </div>

</div>

<div class="fap-content-box fap-box-medium" style="top: 380px; left:290px; height:265px;">
    <div style="margin-top:10px; margin-left: 10px;">
        <div style="width: 50%;">
            <b>FAP Bridge</b>
            <div id="raspbee-bridge-status" class="bold-text">please wait</div>
        </div>
        <div class="fap-button-group-3-horizontal" style="width:165px; position:relative; left:260px; top:-45px; ">
            <div class="fap-button fap-button-function" onclick="window.fapAdmin.pairDevice();">Pair<br />Device
            </div>
            <div class="fap-button fap-button-function" onclick="window.fapAdmin.pairBridge('raspbee');">Pair<br />Bridge
            </div>
            <div class="fap-button fap-button-function" onclick="window.fapAdmin.deleteBridge('raspbee');">Delete<br />Bridge
            </div>
        </div>

        <div style="position: relative; top:-40px">
            <u>Bridge-Pairing-Instructions</u>
            <ul>
                <li>Login to http://{{$serverIp}} on another device, open the menu and click on Gateway</li>
                <li>Click on "Advanced" at the bottom</li>
                <li>Click "Authenticate app"</li>
                <li>Click the "Pair Bridge" Button on this page within 60 seconds.</li>
            </ul>
        </div>

        <div style="position: relative; top:-40px">
            <u>Device-Pairing-Instructions</u>
            <ul>
                <li>Click on the "Pair Device" Button.</li>
                <li>Turn on the device within 60 seconds.</li>
            </ul>
        </div>
    </div>
</div>