@extends('general.aircraft')
@section('module')
    @if(\Illuminate\Support\Env::get('AIRCRAFT') === 'A320')

    @elseif(\Illuminate\Support\Env::get('AIRCRAFT') === 'A346')

    @else
        NO AIRCRAFT SELECTED
    @endif

    <script>
        function getAssignedSensors() {

        }

        $(document).ready(function () {
            $('.fap-aircraft').css('left', '275px');
            getAssignedSensors();
        });
    </script>
@endsection