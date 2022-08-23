<div class="fap-content-box fap-box-large" style="position:relative; top:180px; left: 165px; height:200px;">
    <div class="red-text" style="text-align: center; font-weight: bold; top: 30px; position: relative;">
        Warning! Changing the aircraft layout will remove light,temperature and door setup.
    </div>
    <div style="text-align: center; top: 35px; position: relative;">Current layout: <b>{{ env('AIRCRAFT') }}</b></div>

    <div class="fap-button-group-3-horizontal" style="position: relative; top:50px; left:205px;">
        <div class="fap-button fap-button-layout-change
        @if(env('AIRCRAFT') === 'A320')
        fap-button-inactive
        @endif">
            A320
        </div>
        <div class="fap-button fap-button-layout-change
        @if(env('AIRCRAFT') === 'A346')
        fap-button-inactive
        @endif">
            A346
        </div>
        <div class="fap-button fap-button-layout-change fap-button-inactive">
            A388
        </div>
    </div>
</div>

<script>
    $('.fap-button-layout-change').on('click', function () {
        if (!$(this).hasClass('fap-button-inactive')) {

            $.ajax({
                type:    'GET',
                url:     'setup/aircraft-layout/change',
                data:    {aircraft: $(this).text()}, // serializes the form's elements.
                success: function () {
                    location.reload();
                },
                error:   function (message) {
                    window.fapMain.showPopup(message.responseText);
                },
            });
        }
    });
</script>