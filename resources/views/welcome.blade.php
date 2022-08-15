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
    let fapNavigation = new FapNavigation();
    fapNavigation.getNavigationItems(1);
</script>

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
                <div id="fap-left-arrow" class="fap-arrow"></div>
            </div>

            <div class="fap-button fap-button-navigation" data-menuid="audio">Audio</div>
            <div class="fap-button fap-button-navigation" data-menuid="lights">Lights</div>
            <div class="fap-button fap-button-navigation" data-menuid="doors-slides">Doors/<br />Slides
            </div>
            <div class="fap-button fap-button-navigation" data-menuid="temp">Temp.</div>
            <div class="fap-button fap-button-navigation" data-menuid="water-waste">Water/<br />
                                                                                    Waste
            </div>
            <div class="fap-button fap-button-navigation" data-menuid="smoke-detect">Smoke<br />
                                                                                     Detect.
            </div>
            <div class="fap-button fap-button-navigation fap-button-inactive"></div>
            <div class="fap-button fap-button-navigation fap-button-inactive"></div>
            <div class="fap-button fap-button-navigation" data-menuid="system-info">System<br />
                                                                                    Info
            </div>

            <div id="fap-navigation-right"
                 class="fap-button fap-button-navigation-arrow">
                <div id="fap-right-arrow" class="fap-arrow"></div>
            </div>

        </div>
    </div>
    <div id="fap-navigation-additional-right">
        <div id="fap-cabinstatus" class="fap-button fap-button-active" data-menuid="cabin-status">
            Cabin<br />Status
        </div>
    </div>
</div>

</body>
</html>
