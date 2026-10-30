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

        $('header').on('click', '#search-toggle', function(e) {
            var searchContainer = $('#search-container');
            var searchToggle = $('#search-toggle');
            var closeSearch = $('#close-search');
            var searchQuery = $('#query');

            $(this).attr('aria-expanded', 'true');
            searchQuery.trigger('focus');

            $(document).on('click', function(e) {
                if (!$.contains(searchContainer[0], e.target) && !$(e.target).is('.search-icon, #search-toggle')) {
                    searchToggle.attr('aria-expanded', 'false').focus();
                    $(document).off(e);
                }
            });

            searchContainer.on('keydown', '#close-search', function(e) {
                if (e.key == "Tab" && !e.shiftKey) {
                    e.preventDefault();
                    searchQuery.trigger('focus');
                }
            });

            searchContainer.on('keydown', '#query', function(e) {
                if (e.key == "Tab" && e.shiftKey) {
                    e.preventDefault();
                    closeSearch.trigger('focus');
                }
            });

            searchContainer.on('click', '#close-search', function() {
                searchToggle.attr('aria-expanded', 'false').trigger('focus');
            });

            $(document).on('keydown', function(e) {
                if (e.key == 'Escape') {
                    searchToggle.attr('aria-expanded', 'false').trigger('focus');
                    $(document).off(e);
                };
            });
        });

    });
})(jQuery)