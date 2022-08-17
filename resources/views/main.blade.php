<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FAPv5</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
</head>
<body class="antialiased">
<script>
    let fapMain = new FapMain();
    fapMain.getNavigationItems(1);

    window.fapAudio = new FapAudio();
    window.SetupAudio = new SetupAudio();
</script>

<audio id="fap-audio">
    <source id="fap-audio-file" src="" type="audio/mpeg">
</audio>

<div id="fap-main">
    <div id="fap-top">
        <div id="fap-navigation-caution" class="fap-button" data-menuid="caution">
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
        @yield('content')
    </div>
    <div id="fap-navigation-additional-left">
        <div id="fap-screenoff" class="fap-button fap-button-function" data-menuid="screenoff">
            Screen<br />Off
        </div>
        <div id="fap-cabinready" class="fap-button fap-button-toggle" data-menuid="cabinready">
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
        <div id="fap-cabin-status" class="fap-button fap-button-active" data-menuid="cabin-status">
            Cabin<br />Status
        </div>
    </div>
</div>

</body>
</html>
