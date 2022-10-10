@component('general.aircraft')
    <div style="position: absolute;">
        @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
            <div class="smoke-detector" style="top:58px; left:16px;"></div>
            <div class="smoke-detector" style="top:385px; left:10px;"></div>
            <div class="smoke-detector" style="top:495px; left:16px;"></div>
        @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
            <div class="smoke-detector" style="top:58px; left:16px;"></div>
            <div class="smoke-detector" style="top:160px; left:10px;"></div>
            <div class="smoke-detector" style="top:275px; left:10px;"></div>
            <div class="smoke-detector" style="top:385px; left:10px;"></div>
            <div class="smoke-detector" style="top:495px; left:16px;"></div>
        @endif
    </div>
@endcomponent