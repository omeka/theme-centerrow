(function($) {
    $(document).ready(function() {
        $('#advanced-form').parents('#search-container').addClass('with-advanced');

        $('.search-toggle').click(function() {
            $('#search-form').toggleClass('closed').toggleClass('open');
            if ($('#search-form').hasClass('open')) {
                $('#query').focus();
            }
        });
    });
})(jQuery)