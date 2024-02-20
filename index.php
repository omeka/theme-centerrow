<?php
$featuredHtml = centerrow_featured_html();
$autoplay = (get_theme_option('home_slider_autoplay') !== null) ? get_theme_option('home_slider_autoplay') : '1';
$autoplaySpeed = (get_theme_option('home_slider_autoplay_speed') !== null) ? (int) get_theme_option('home_slider_autoplay_speed') : 5000;
$autoplayOptions = ($autoplay == '1') ? 'autoplay: true, autoplaySpeed: ' . $autoplaySpeed . ',' : 'autoplay: false,';
queue_css_url('//cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.css');
queue_css_url('//cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/accessible-slick-theme.min.css');
queue_js_string('
    jQuery(document).ready(function(){
      jQuery("#featured-slides").slick({
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,' . 
        $autoplayOptions . 
        'arrows: false,
        centerMode: true,
        fade: true,
      });
    });
');
?>
<?php echo head(array('bodyid'=>'home')); ?>

<!-- Featured Item -->

<?php if (centerrow_check_for_featured_records()): ?>
<div id="featured">
    <div id="featured-slides">
        <?php echo centerrow_featured_html(); ?>
    </div>
</div>
<?php endif; ?>

<?php if (get_theme_option('Homepage Text')): ?>
<div id="homepage-text"><?php echo get_theme_option('Homepage Text'); ?></div>
<?php endif; ?>

<?php fire_plugin_hook('public_home', array('view' => $this)); ?>


<script type="text/javascript" src="//cdn.jsdelivr.net/npm/@accessible360/accessible-slick@1.0.1/slick/slick.min.js"></script>

<?php echo foot(); ?>
