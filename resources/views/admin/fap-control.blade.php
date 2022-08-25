<div class="fap-content-box fap-box-smaller" style="position: relative; top:110px; left:350px;">
    <div class="fap-box-title">FAP</div>
    <div class="fap-button-group-3-horizontal">
        <div class="fap-button fap-control" data-function="fap.stop">STOP</div>
        <div class="fap-button fap-button-inactive">Restart</div>
        <div class="fap-button fap-button-inactive"></div>
    </div>
</div>

<div class="fap-content-box fap-box-smaller" style="position: relative; top:150px; left:350px;">
    <div class="fap-box-title">FAP-SERVER</div>
    <div class="fap-button-group-3-horizontal">
        <div class="fap-button fap-control" data-function="server.stop" style="color: #f00;">STOP</div>
        <div class="fap-button fap-control" data-function="server.restart">Restart</div>
        <div class="fap-button fap-button-inactive"></div>
    </div>
</div>

<script>
    $('.fap-control').on('click', function () {
        let command = $(this).data('function');
        $.ajax({
            type:    'GET',
            url:     'admin/fap-control/send-command',
            data:    {command: command},
            success: function () {
                $('#fap-main').hide();
                $('#fap-maintenance-mode').show();
            },
        });
    });
</script>
