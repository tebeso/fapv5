@extends('general.aircraft')

@section('module')
    <div class="smoke-detector" style="top:58px; left:16px;"></div>
    <div class="smoke-detector" style="top:150px; left:10px;"></div>
    <div class="smoke-detector" style="top:253px; left:10px;"></div>
    <div class="smoke-detector" style="top:352px; left:10px;"></div>
    <div class="smoke-detector" style="top:451px; left:16px;"></div>
@endsection

@section('module-js')
    <script>
        $('.fap-aircraft').css('left', '420px');
    </script>
@endsection

