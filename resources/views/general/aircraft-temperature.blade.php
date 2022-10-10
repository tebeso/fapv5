@component('general.aircraft')
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
        <div id="temperature-320-zone-1" data-zone="FWD" class="temperature-block temperature-block-320"
             style="top:80px;">X.X
        </div>
        <div id="temperature-320-zone-2" data-zone="AFT" class="temperature-block temperature-block-320"
             style="top:100px;">X.X
        </div>
    @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
        <div id="temperature-346-zone-1" data-zone="Zone 1" class="temperature-block temperature-block-346"
             style="top:80px;">X.X
        </div>
        <div id="temperature-346-zone-2" data-zone="Zone 2" class="temperature-block temperature-block-346"
             style="top:90px;">X.X
        </div>
        <div id="temperature-346-zone-3" data-zone="Zone 3" class="temperature-block temperature-block-346"
             style="top:100px;">X.X
        </div>
        <div id="temperature-346-zone-4" data-zone="Zone 4" class="temperature-block temperature-block-346"
             style="top:110px;">X.X
        </div>
    @endif
@endcomponent