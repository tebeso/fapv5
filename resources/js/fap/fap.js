window.$ = require('jquery');

window.FapNavigation = class FapNavigation {
    constructor() {
        let $this = this;
        $(document).ready(function () {
            $('.fap-arrow').parent().on('click', function () {
                let menuId = $(this).find('.fap-arrow').data('menuid');

                if (menuId) {
                    $this.getNavigationItems(menuId);
                }
            });

            $(document).on('click', '.fap-button-navigation', function () {
                $this.loadPageContent($(this));
            });

            $('#fap-cabinstatus').on('click', function () {
                $this.loadPageContent($(this));
            });
        });
    }

    loadPageContent(button) {
        let menuId = button.data('menuid');
        console.log(menuId);

        /**
         * Remove active state from all buttons.
         */
        $('.fap-button-navigation').removeClass('fap-button-active');
        $('#fap-cabinstatus').removeClass('fap-button-active');

        /**
         * Set clicked button to active.
         */
        button.addClass('fap-button-active');

        /**
         * Set the current menuId as an attribute to the navigation, so we can set it to active if we switch back and forth with the arrows.
         */
        $('#fap-navigation').data('currentMenuId', menuId);

        /**
         * Load Page.
         */
        $('#fap-content').load('/' + menuId);
    }

    /**
     * Gets all navigation buttons for the current page.
     *
     * @param id
     */
    getNavigationItems(id) {
        let $this = this;

        $.ajax({
            type:    'GET',
            url:     '/navigationItems/' + id,
            cache:   true,
            success: function (data) {

                let items = data.items;

                /**
                 * Delete all buttons in the navigation first.
                 */
                $('.fap-button-navigation').remove();

                /**
                 * Change the state of the left and right arrows.
                 */
                $this.changeArrowState('#fap-left-arrow', data.prev, id - 1);
                $this.changeArrowState('#fap-right-arrow', data.next, id + 1);

                /**
                 * Add buttons for the current page.
                 */
                $(items).each(function (_index, item) {
                    $this.addNavigationItem(item);
                });

                /**
                 * Change slider position.
                 */
                $this.changeSliderPosition(id);
            },
        });
    }

    /**
     * Change slider position.
     *
     * @param id
     */
    changeSliderPosition(id) {
        $('#fap-navigation-slider').removeAttr('class').addClass('fap-navigation-slider-pos' + id);
    }

    /**
     * Add buttons for the current page.
     */
    addNavigationItem(item) {
        let lastArrow = $('.fap-button-navigation-arrow').last();
        let element   = $('<div class="fap-button fap-button-navigation fap-button-inactive"></div>');

        /**
         * Button is a nav item and not a blank item
         */
        if (item.type === 'nav-item') {
            element = $('<div class="fap-button fap-button-navigation">' + item.name + '</div>').data('menuid', item.menuId);

            /**
             * If the current page has the same id as the button, set the button to active.
             */
            console.log($('#fap-navigation').data('currentMenuId'));
            if ($('#fap-navigation').data('currentMenuId') === item.menuId) {
                element.addClass('fap-button-active');
            }
        }

        element.insertBefore(lastArrow);
    }

    /**
     * Change the state of the left and right arrows.
     * If the next or previous page does not have any elements, set arrow to inactive.
     */
    changeArrowState(elementId, state, idOnPush) {
        if (state === true) {
            $(elementId).removeClass('fap-arrow-inactive').addClass('fap-arrow-active');
            $(elementId).parent().removeClass('fap-button-inactive');
            $(elementId).data('menuid', idOnPush);
        } else {
            $(elementId).addClass('fap-arrow-inactive').removeClass('fap-arrow-active');
            $(elementId).parent().addClass('fap-button-inactive');
            $(elementId).removeData('menuid');
        }
    }
};