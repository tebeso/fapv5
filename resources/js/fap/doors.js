window.FapDoors = class FapDoors {
    constructor() {
        this.getDoorState();

        let $this = this;

        setInterval(
            function () {
                let title = $('#fap-page-title').text().trim();

                if (title === 'SETUP DOORS' || title === 'DOORS/SLIDES') {
                    $this.getDoorState();
                }
            },
            1000,
        );
    }

    getDoorState() {
        let $this = this;

        $.ajax({
            type:    'GET',
            url:     'doors-slides/get-state-assigned',
            timeout: 3000,
            success: function (message) {
                $.each(message, function (position, attributes) {
                    position = position.replace('select-', '');

                    let positionBlock     = $('#' + position);
                    let positionBlockOpen = $('#' + position + '-open');
                    let labelBlock        = $('#label-' + position);
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