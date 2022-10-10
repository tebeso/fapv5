<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FAPv5</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        window.fapMain        = new FapMain();
        window.fapAdmin       = new FapAdmin();
        window.fapAudio       = new FapAudio();
        window.fapLight       = new FapLight();
        window.fapSensor      = new FapSensor();
        window.fapTemperature = new FapTemperature();
        window.fapDoors       = new FapDoors();
        window.fapSmoke       = new FapSmoke();

        window.fapMain.getNavigationItems(1);
    </script>
</head>
<body class="antialiased">
<audio id="fap-audio">
    <source id="fap-audio-file" src="" type="audio/mpeg">
</audio>
<div id="fap-screensaver" class="no-select"></div>
<div id="fap-maintenance-mode" class="no-select"></div>
<div id="fap-main">
    <div id="fap-top">
        <div id="fap-navigation-caution" class="fap-button fap-button-inactive" data-menuid="caution">
            CAUT
        </div>
        <div id="fap-page-title" data-menuid="cabinstatus">
            Cabin Status
        </div>
        <div id="fap-help" class="fap-button fap-button-toggle" data-menuid="help">
            Help
        </div>

    </div>
    <div id="fap-content" class="white-text">

    </div>
    <div id="fap-navigation-additional-left">
        <div id="fap-screen-off" class="fap-button fap-button-function">
            Screen<br />Off
        </div>
        <div id="fap-cabin-ready" class="fap-button fap-button-toggle">
            Cabin<br />Ready
        </div>
    </div>
    <div id="fap-navigation">

        <div id="fap-navigation-slider" class="fap-navigation-slider-pos1"></div>

        <div id="fap-navigation-buttons">

            <div id="fap-navigation-left"
                 class="fap-button fap-button-navigation-arrow">
                <div id="fap-menu-left-arrow" class="fap-arrow  fap-left-arrow"></div>
            </div>

            <!-- Button are inserted here dynamically. -->

            <div id="fap-navigation-right"
                 class="fap-button fap-button-navigation-arrow">
                <div id="fap-menu-right-arrow" class="fap-arrow fap-right-arrow"></div>
            </div>

        </div>
    </div>
    <div id="fap-navigation-additional-right">
        <div id="fap-cabin-status" class="fap-button fap-button-active" data-menuid="cabin-status"
             data-title="CABIN STATUS">
            Cabin<br />Status
        </div>
    </div>
</div>

<div id="smoke-detected-popup" class="fap-content-box" style="display:none;">
    <div style="text-align: center;">
        <div class="smoke-detector red-bg" style="position: absolute; left:50%; top:20px;"></div>
    </div>
    <div style="position: absolute; top:50px; line-height: 30px; background-color: #ff0000; color: #fff; text-align: center; width:92%;">
        SMOKE<br />DETECTED
    </div>
    <div class="fap-button" style="top:115px; left:50%;">SMOKE<br />RESET</div>
</div>

<div id="message-popup" class="fap-content-box" style="display: none;">
    <div id="message">

    </div>
    <div class="fap-button" style="line-height: 55px; float: right;" onclick="fapMain.hidePopup();">OK</div>
</div>

<script>
    window.fapMain.loadPageContent($('#fap-cabin-status'));
</script>
</body>
</html>
