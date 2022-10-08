<div class="fap-aircraft">
    @if(Env('AIRCRAFT') === 'A346')
        <div id="door-one-left" class="door door-one door-front-rear"></div>
        <div id="door-one-right" class="door door-one door-front-rear"></div>

        <div id="door-two-left" class="door door-two door-generic "></div>
        <div id="door-two-right" class="door door-two door-generic "></div>

        <div id="door-three-left" class="door door-three door-overwing "></div>
        <div id="door-three-right" class="door door-three door-overwing "></div>

        <div id="door-four-left" class="door door-four door-generic "></div>
        <div id="door-four-right" class="door door-four door-generic "></div>

        <div id="door-five-left" class="door door-five door-front-rear "></div>
        <div id="door-five-right" class="door door-five door-front-rear"></div>
    @elseif(Env('AIRCRAFT') ==='A320')
        <div id="door-one-left" class="door door-one door-front-rear"></div>
        <div id="door-one-right" class="door door-one door-front-rear"></div>
        <div id="door-five-left" class="door door-five door-front-rear "></div>
        <div id="door-five-right" class="door door-five door-front-rear"></div>
    @endif
    {{ $slot }}
</div>

@yield('module-js')