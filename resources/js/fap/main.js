window.$ = require('jquery');

window.FapMain = class FapMain {
    constructor() {
        this.loadEvents();
    }

    loadEvents() {
        let $this = this;

        $(document).on('mousedown', '.fap-button-function', function(){
            if(!$(this).hasClass('fap-button-active')){
                $(this).addClass('fap-button-active');
            }
        })

        window.addEventListener('mouseup', function () {
            $('.fap-button-function').removeClass('fap-button-active');
        });

        $(document).ready(function () {
            $('.fap-button-navigation-arrow').on('click', function () {
                let menuId = $(this).children(':first').data('menuid');

                if (menuId) {
                    $this.getNavigationItems(menuId);
                }
            });

            $(document).on('click', '.fap-button-navigation', function () {
                if (!$(this).hasClass('fap-button-inactive')) {
                    $this.loadPageContent($(this));
                }
            });

            $('#fap-cabin-status').on('click', function () {
                $this.loadPageContent($(this));
            });

            $('#fap-screen-off').on('click', function () {
                /** active screensaver */
                setTimeout(function () {
                    $('#fap-main').hide();
                    $('#fap-screensaver').show();
                }, 200);
            });

            $('#fap-screensaver').on('click', function () {
                setTimeout(function () {
                    $('#fap-screensaver').hide();
                    $('#fap-main').show();
                }, 200);
            });

            $('.fap-button-toggle').on('click', function () {
                $(this).toggleClass('fap-button-active');
            });
        });
    }

    /**
     * Loads page content, sets button active and sets title.
     *
     * @param button
     */
    loadPageContent(button) {
        let menuId = button.data('menuid');

        /**
         * Remove active state from all buttons.
         */
        $('.fap-button-navigation').removeClass('fap-button-active');
        $('#fap-cabin-status').removeClass('fap-button-active');

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

        /**
         * Set Page title.
         */
        this.changePageTitle(button.data('title'));

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
            url:     '/navigation-items/' + id,
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
                $this.changeArrowState('#fap-menu-left-arrow', data.prev, id - 1);
                $this.changeArrowState('#fap-menu-right-arrow', data.next, id + 1);

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
     *
     * @param {{menuId:string}} item
     * @param {{type:string}} item
     * @param {{button:string}} item
     * @param {{title:string}} item
     */
    addNavigationItem(item) {
        let lastArrow = $('.fap-button-navigation-arrow').last();
        let element   = $('<div class="fap-button fap-button-navigation fap-button-inactive"></div>');

        /**
         * Button is a nav item and not a blank item
         */
        if (item.type === 'nav-item') {
            element = $('<div class="fap-button fap-button-navigation">' + item.button + '</div>').data('menuid', item.menuId).data('title', item.title);

            /**
             * If the current page has the same id as the button, set the button to active.
             */
            if ($('#fap-navigation').data('currentMenuId') === item.menuId) {
                element.addClass('fap-button-active');
            }
        }

        if (item.type === 'nav-item-disabled') {
            element = $('<div class="fap-button fap-button-inactive fap-button-navigation">' + item.button + '</div>');
        }

        element.insertBefore(lastArrow);
    }

    /**
     * Change the state of the left and right arrows.
     * If the next or previous page does not have any elements, set arrow to inactive.
     */
    changeArrowState(elementId, state, idOnPush) {
        if (state === true) {
            $(elementId).removeClass('fap-arrow-inactive')
                        .data('menuid', idOnPush)
                        .parent().removeClass('fap-button-inactive');
        } else {
            $(elementId).addClass('fap-arrow-inactive')
                        .removeData('menuid')
                        .parent().addClass('fap-button-inactive');
        }
    }

    changePageTitle(title) {
        $('#fap-page-title').text(title);
    }

    showPopup(message, addClass = '') {
        $('#message-popup').show();
        $('#message').text(message).addClass(addClass);
    }

    hidePopup() {
        $('#message-popup').hide();
    }
};