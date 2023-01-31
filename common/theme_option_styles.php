<?php
    ($bodyBgColor = get_theme_option('body_bg_color')) || ($buttonBgColor = "#FFFFFF");
    ($borderColor = get_theme_option('border_color')) || ($buttonBgColor = "#DEDEDE");
    ($linkColor = get_theme_option('link_color')) || ($linkColor = "#C72E2E");
    ($headerImageHeight = get_theme_option('header_image_height')) || ($headerImageHeight = "auto");
    $headerImageHeightMobile = get_theme_option('header_image_height_mobile');
    $headerEverywhere = get_theme_option('header_everywhere');
    $headerImagePosition = get_theme_option('header_image_position');
    $headerImagePosition = str_replace('_', '-', $headerImagePosition);
?>

<style>

body,
#search-form,
#search-container input[type="text"],
#search-container button,
#advanced-form {
    background-color: <?php echo $bodyBgColor; ?>
}

header nav .navigation,
#search-container input[type="text"],
#search-container button,
#search-form.closed + .search-toggle,
#advanced-form,
#search-filters ul li,
#item-filters ul li,
.element-set h2,
#exhibit-page-navigation,
#exhibit-pages > ul > li:not(:last-of-type),
#exhibit-pages h4,
table,
th, 
td,
.search-entry,
.item-pagination.navigation,
.secondary-nav ul {
    border-color: <?php echo $borderColor; ?>
}

a,
.secondary-nav.navigation li.active a,
.pagination-nav .sorting a,
#sort-links .sorting a,
#exhibit-pages .current a {
    color: <?php echo $linkColor; ?>;
}

<?php if ($headerEverywhere !== '1'): ?>
#home #header-image {
    display: none;
}
<?php endif; ?>

#header-image {
    height: <?php echo $headerImageHeight; ?>;
    align-items: <?php echo $headerImagePosition; ?>;
}
<?php if ($headerImageHeightMobile !== ''): ?>
@media screen and (max-width:640px) {
    #header-image {
        height: <?php echo $headerImageHeightMobile; ?>;
    }
}
<?php endif; ?>
</style>