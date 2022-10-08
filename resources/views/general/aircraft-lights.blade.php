@component('general.aircraft')
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
        <div id="lights-320-346-fwd-entry" class="lights lights-entry"></div>
        <div id="lights-320-business" class="lights"></div>
        <div id="lights-320-economy" class="lights"></div>
        <div id="lights-320-346-aft-entry" class="lights lights-entry"></div>

        <div id="lights-320-business-label" class="lights-label black-text">C/CI</div>
        <div id="lights-320-economy-label" class="lights-label black-text">Y/CI</div>
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
    @endif
@endcomponent