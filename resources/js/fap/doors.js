window.FapDoors = class FapDoors {
    constructor() {
        let $this = this;

        setInterval(
            function () {
                let title = $('#fap-page-title').text().trim();

                if (title === 'SETUP DOORS' || title === 'DOORS/SLIDES') {
                    $this.getDoorState();
                }
                if (title === 'CABIN STATUS') {
                    $this.getDoorState();
                }
            },
            500,
        );
    }

    getDoorState() {
        $.ajax({
            type:    'GET',
            url:     'doors-slides/get-state-assigned',
            timeout: 3000,
            success: function (message) {
                $.each(message, function (position, attributes) {
                    position = position.replace('select-', '');
                    let positionBlock     = $('.aircraft-module-doors #' + position);
                    let positionBlockOpen = $('.aircraft-module-doors #' + position + '-open');
                    let labelBlock        = $('.aircraft-module-doors #label-' + position);
                    let state             = attributes.state;

                    if (state === true) {
                        positionBlockOpen.css('visibility', 'visible');
                        positionBlock.css('background', 'transparent');
                        labelBlock.css('visibility', 'hidden');
                    } else {
                        positionBlockOpen.css('visibility', 'hidden');
                        positionBlock.css('background', '#EAB05C');
                        labelBlock.css('visibility', 'visible');
                    }
                });
            },
        });
    }
};