<?php
$autoplay = (get_theme_option('home_slider_autoplay') !== null) ? get_theme_option('home_slider_autoplay') : '1';
$autoplaySpeed = (get_theme_option('home_slider_autoplay_speed') !== null) ? get_theme_option('home_slider_autoplay_speed') : '5000,';
$autoplayOptions = ($autoplay == '1') ? 'autoplay: true, autoplaySpeed: ' . $autoplaySpeed : 'autoplay: false,';
queue_css_url('//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.css');
queue_js_url('//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js');
queue_js_string('
    jQuery(document).ready(function(){
      jQuery("#featured").slick({
        slidesToShow: 1,
        slidesToScroll: 1,' . 
        $autoplayOptions . 
        'arrows: false,
        centerMode: true,
        fade: true,
        dots: true
      });
    });
');
?>
<?php echo head(array('bodyid'=>'home')); ?>

<!-- Featured Item -->
<div id="featured">

    <?php if (get_theme_option('Display Featured Item') !== '0' && count(get_random_featured_items()) > 0): ?>
    <?php echo random_featured_items(3); ?>
    <?php endif; ?>
    <?php if (get_theme_option('Display Featured Collection') !== '0' && get_random_featured_collection()): ?>
    <?php echo random_featured_collection(); ?>
    <?php endif; ?>
    <?php if ((get_theme_option('Display Featured Exhibit') !== '0')
            && plugin_is_active('ExhibitBuilder')
            && function_exists('centerrow_display_featured_exhibit')): ?>
    <!-- Featured Exhibit -->
    <?php echo centerrow_display_featured_exhibit(); ?>
    <?php endif; ?>
</div><!--end featured-item-->

<?php if (get_theme_option('Homepage Text')): ?>
<div id="homepage-text"><?php echo get_theme_option('Homepage Text'); ?></div>
<?php endif; ?>

<?php fire_plugin_hook('public_home', array('view' => $this)); ?>

<?php echo foot(); ?>
