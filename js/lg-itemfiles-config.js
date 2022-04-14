(function($) {
    $(document).ready(function() {        
        var galleryState = ($('#itemfiles li').length > 1) ? true : false;

        var lgContainer = document.getElementById('itemfiles');
        var inlineGallery = lightGallery(lgContainer, {
            container: lgContainer,
            dynamic: false,
            hash: true,
            closable: false,
            thumbnail: true,
            selector: '.media.resource',
            showMaximizeIcon: true,
            autoplayFirstVideo: false,
            exThumbImage: 'data-thumb',
            flipVertical: false,
            flipHorizontal: false,
            zoom: 1,
            showZoomInOutIcons: true,
            actualSizeIcons: {
                zoomIn: 'hidden', 
                zoomOut: 'o-icon-undo',
            },
            plugins: [
                lgThumbnail,lgZoom,lgVideo,lgHash,lgRotate
            ],
        });

        inlineGallery.openGallery();
    });
})(jQuery)

