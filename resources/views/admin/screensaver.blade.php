<div class="fap-content-box fap-box-smaller" style="position: relative; top:110px; left:350px; height:130px;">
    <div class="fap-box-title">Screensaver</div>
    <div class="fap-button-group-3-horizontal">
        <div class="fap-button fap-control fap-button-function" data-file="screensaver-lufthansa.png">LH</div>
        <div class="fap-button fap-control fap-button-function" data-file="screensaver-airberlin.png">AB</div>
        <div class="fap-button fap-control fap-button-function" data-file="screensaver-ltu.png">LTU</div>
    </div>
    <div class="fap-button-group-3-horizontal" style="top:75px;">
        <div class="fap-button fap-control fap-button-function" data-file="screensaver-airbus.png">Airbus</div>
        <div class="fap-button fap-button-inactive"></div>
        <div class="fap-button fap-button-inactive"></div>
    </div>
</div>


<script>
    $('.fap-control').on('click', function () {
        let file = $(this).data('file');
        console.log(file);
        $.ajax({
            type:    'GET',
            url:     'admin/screensaver/change',
            data:    {file: file},
            success: function () {
                // show popup with notice, that a restart might be required if the image doesnt change
                window.fapMain.showPopup('Screensaver has been changed.');
                $('#fap-screensaver').css('background-image', 'url(images/screensaver/'+file+')');
            },
        });
    });
</script>
