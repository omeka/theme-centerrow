<?php
function centerrow_featured_html() {
    $featuredHtml = '';
    $featuredRecordTypes = ['Exhibit', 'Collection', 'Item'];
    foreach ($featuredRecordTypes as $featuredRecordType) {
        if (get_theme_option('display_featured_' . strtolower($featuredRecordType)) == '1') {
           $featuredHtml .= display_records($featuredRecordType, 5, 'common/featured.php', ['recordType' => $featuredRecordType]);
        }
    }
    return $featuredHtml;
}

function centerrow_get_square_thumbnail_url($file, $view) {
    if ($file->hasThumbnail()) {
        $squareThumbnail = file_display_url($file, 'square_thumbnail');
    } else {
        $mimeType = $file->mime_type;
        $fileType = (strpos($mimeType, 'image')) ? 'image' : 'video';
        $squareThumbnail = $view->baseUrl() . '/application/views/scripts/images/fallback-' . $fileType . '.png';
    }
    return $squareThumbnail;
}

function centerrow_public_nav_main() {
    $view = get_view();
    $nav = new Omeka_Navigation;
    $nav->loadAsOption(Omeka_Navigation::PUBLIC_NAVIGATION_MAIN_OPTION_NAME);
    $nav->addPagesFromFilter(Omeka_Navigation::PUBLIC_NAVIGATION_MAIN_FILTER_NAME);
    $html = $view->navigation()->menu($nav)->setPartial('common/accessible-megamenu.php')->render();
    $view->navigation()->menu($nav)->setPartial(null);
    return $html;
}
?>