if (!CenterRow) {
    var CenterRow = {};
}

(function($) {

    CenterRow.megaMenu = function (menuSelector, customMenuOptions) {
        if (typeof menuSelector === 'undefined') {
            menuSelector = 'header nav';
        }

        var menuOptions = {
            /* prefix for generated unique id attributes, which are required
             to indicate aria-owns, aria-controls and aria-labelledby */
            uuidPrefix: "accessible-megamenu",

            /* css class used to define the megamenu styling */
            menuClass: "nav-menu",

            /* css class for a top-level navigation item in the megamenu */
            topNavItemClass: "nav-item",

            /* css class for a megamenu panel */
            panelClass: "sub-nav",

            /* css class for a group of items within a megamenu panel */
            panelGroupClass: "sub-nav-group",

            /* css class for the hover state */
            hoverClass: "hover",

            /* css class for the focus state */
            focusClass: "focus",

            /* css class for the open state */
            openClass: "open",

            openOnMouseover: true,
        };

        $.extend(menuOptions, customMenuOptions);

        $(menuSelector).accessibleMegaMenu(menuOptions);
    };

    $(document).ready(function() {
        $('#advanced-form').parents('#search-container').addClass('with-advanced');

        $('#search-container').on('click', '.search-toggle', function() {
            var searchToggle = $(this);
            $('#search-form').toggleClass('closed').toggleClass('open');
            if ($('#search-form').hasClass('open')) {
                searchToggle.attr('aria-expanded', 'true');
                $('#query').focus();
            } else {
                searchToggle.attr('aria-expanded', 'false');
            }
        });
    });
})(jQuery)