@extends('general.aircraft')
@section('module')
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')
        <div id="temperature-320-zone-1" class="temperature-block temperature-block-320" style="top:80px;">X.X</div>
        <div id="temperature-320-zone-2" class="temperature-block temperature-block-320" style="top:110px;">X.X</div>
    @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')
        <div id="temperature-346-zone-1" class="temperature-block temperature-block-346" style="top:80px;">X.X</div>
        <div id="temperature-346-zone-2" class="temperature-block temperature-block-346" style="top:90px;">X.X</div>
        <div id="temperature-346-zone-3" class="temperature-block temperature-block-346" style="top:100px;">X.X</div>
        <div id="temperature-346-zone-4" class="temperature-block temperature-block-346" style="top:110px;">X.X</div>
    @else
        NO AIRCRAFT SELECTED
    @endif

    <script>
        function getAssignedSensors() {
            $.ajax({
                type:    'GET',
                url:     'setup/sensors/get-assigned-sensors',
                data:    {type: 'temp'},
                success: function (message) {
                    $.each(JSON.parse(message), function (position, sensor) {
                        $('#' + position).val(sensor);
                    });
                },
            });
        }

        $(document).ready(function () {
            $('.fap-aircraft').css('left', '420px');
            getAssignedSensors();
        });
    </script>
@endsection