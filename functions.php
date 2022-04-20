<?php

function centerrow_display_featured_exhibit() {
    $html = '';
    $featuredExhibit = exhibit_builder_random_featured_exhibit();
    if ($featuredExhibit) {
        $html .= get_view()->partial('exhibit-builder/exhibits/single.php', array('exhibit' => $featuredExhibit));
    }
    $html = apply_filters('exhibit_builder_display_random_featured_exhibit', $html);
    return $html;
}

function centerrow_sort_files($files = null) {
    $sortedMedia = [];
    $whitelist = ['image/bmp', 'image/gif', 'image/jpeg', 'image/png', 'image/svg+xml', 'video/flv', 'video/x-flv', 'video/mp4', 'video/m4v',
                'video/webm', 'video/wmv', 'video/quicktime', 'application/pdf'];
    $html5videos = [];
    $mediaCount = 0;

    foreach ($files as $media) {
        $mediaType = $media->mime_type;
        if (in_array($mediaType, $whitelist)) {
            $sortedMedia['lightMedia'][$mediaCount]['media'] = $media;
            if (strpos($mediaType,'video') !== false) {
                $html5videos[$mediaCount] = pathinfo($media->filename, PATHINFO_FILENAME);
                $sortedMedia['lightMedia'][$mediaCount]['tracks'] = [];
            }
            $mediaCount++;
        } else {
            $sortedMedia['otherMedia'][] = $media;
        }
    }
    if ((count($html5videos) > 0) && isset($sortedMedia['otherMedia'])) {
        foreach ($html5videos as $fileId => $filename) {
            foreach ($sortedMedia['otherMedia'] as $key => $otherMedia) {
                if ($otherMedia->filename == "$filename.vtt") {
                    $sortedMedia['lightMedia'][$fileId]['tracks'][] = $otherMedia;
                    unset($sortedMedia['otherMedia'][$key]);
                }
            }
        }   
    }

    return $sortedMedia;
}

function centerrow_output_lightgallery($files = null) {
    $html = '<ul id="itemfiles" class="media-list">';
    $mediaCaption = get_theme_option('media_caption');

    foreach ($files as $file) {
        $media = $file['media'];
        $source = (metadata($media, 'uri')) ? metadata($media, 'uri') : metadata($media, 'uri'); 
        $mediaCaptionOptions = [
            'none' => '',
            'title' => 'data-sub-html="' . metadata($media, 'display_title') . '"',
            'description' => 'data-sub-html="'. metadata($media, array('Dublin Core', 'Description')) . '"'
        ];
        $mediaCaptionAttribute = ($mediaCaption) ? $mediaCaptionOptions[$mediaCaption] : '';
        $mediaType = ($media->mime_type == 'video/quicktime') ? 'video/mp4' : $media->mime_type;
        if (strpos($mediaType, 'video') !== false) {
            $videoSrcObject = [
                'source' => [
                    [
                        'src' => $source, 
                        'type' => $mediaType,
                    ]
                ], 
                'attributes' => [
                    'preload' => false, 
                    'playsinline' => true, 
                    'controls' => true,
                ],
            ];
            if (isset($file['tracks'])) {
                foreach ($file['tracks'] as $key => $track) {
                    $label = metadata($track, 'display_title');
                    $srclang = (metadata($track, 'dcterms:language')) ? metadata($track, 'dcterms:language') : '';
                    $type = (metadata($track, 'dcterms:type')) ? metadata($track, 'dcterms:type') : 'captions';
                    $videoSrcObject['tracks'][$key]['src'] = $track->getWebPath();
                    $videoSrcObject['tracks'][$key]['label'] = $label;
                    $videoSrcObject['tracks'][$key]['srclang'] = $srclang;
                    $videoSrcObject['tracks'][$key]['kind'] = $type;
                }
            }
            $videoSrcJson = json_encode($videoSrcObject);
            $videoThumbnail = ($media->hasThumbnail()) ? metadata($media, 'thumbnail_uri') : img('fallback-video.png');
            $html .=  '<li data-video="' . html_escape($videoSrcJson) . '" ' . $mediaCaptionAttribute . 'data-thumb="' . html_escape($videoThumbnail) . '" data-download-url="' . $source . '" class="media resource">';
        } else if ($mediaType == 'application/pdf') {
            $html .=  '<li data-iframe="' . html_escape($source) . '" '. $mediaCaptionAttribute . 'data-src="' . $source . '" data-thumb="' . html_escape(metadata($media, 'thumbnail_uri')) . '" data-download-url="' . $source . '" class="media resource">';
        } else {
            $html .=  '<li data-src="' . $source . '" ' . $mediaCaptionAttribute . 'data-thumb="' . html_escape(metadata($media, 'thumbnail_uri')) . '" data-download-url="' . $source . '" class="media resource">';
        }
        $html .= file_markup($media);
        $html .= '</li>';
    }
    $html .= '</ul>';

    return $html;
}

function centerrow_output_text_track_file($textFile) {
    $kind = metadata($textFile, array('Dublin Core', 'Type'));
    $language = metadata($textFile, array('Dublin Core', 'Language'));
    $label = metadata($textFile, array('Dublin Core', 'Title'));

    if (!$kind) {
        $kind = 'subtitles';
    }

    if (!$language) {
        $language = get_html_lang();
    }

    $trackSrc = html_escape($textFile->getWebPath('original'));

    if ($label) {
        $labelPart = ' label="' . $label . '"';
    } else {
        $labelPart = '';
    }

    $track = '<track kind="' . $kind . '" src="' . $trackSrc . '" srclang="' . $language . '"' . $labelPart . '>';

    return $track;
}

function centerrow_check_for_tracks($files) {
    foreach ($files as $file) {
        if ($file->getExtension() == "vtt") {
            return true;
        }
    }
    return false;
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

function centerrow_public_nav_main()
{
    $view = get_view();
    $nav = new Omeka_Navigation;
    $nav->loadAsOption(Omeka_Navigation::PUBLIC_NAVIGATION_MAIN_OPTION_NAME);
    $nav->addPagesFromFilter(Omeka_Navigation::PUBLIC_NAVIGATION_MAIN_FILTER_NAME);
    $html = $view->navigation()->menu($nav)->setPartial('common/accessible-megamenu.php')->render();
    $view->navigation()->menu($nav)->setPartial(null);
    return $html;
}
?>