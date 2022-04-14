<?php
$linkToFileMetadata = get_option('link_to_file_metadata');
$itemFiles = $item->Files;
$visualMedia = array();
$otherFiles = array();
$sortedMedia = centerrow_sort_files($itemFiles);
$visualMedia = (isset($sortedMedia['lightMedia'])) ? $sortedMedia['lightMedia'] : null;
$otherMedia = (isset($sortedMedia['otherMedia'])) ? $sortedMedia['otherMedia'] : null;
$hasVisualMedia = (count($visualMedia) > 0);
if ($hasVisualMedia) {
    queue_css_file('lightgallery.min', 'all', false, 'vendor/lightgallery/css');
    queue_js_file('lightgallery.min', 'vendor/lightgallery/js');
    queue_js_file('lg-thumbnail', 'vendor/lightgallery/js/plugins/thumbnail');
    queue_js_file('lg-zoom', 'vendor/lightgallery/js/plugins/zoom');
    queue_js_file('lg-video', 'vendor/lightgallery/js/plugins/video');
    queue_js_file('lg-rotate', 'vendor/lightgallery/js/plugins/rotate');
    queue_js_file('lg-hash', 'vendor/lightgallery/js/plugins/hash');
    queue_js_file('lg-itemfiles-config', 'js');
}
echo head(array('title' => metadata('item', array('Dublin Core', 'Title')), 'bodyclass' => 'items show'));
?>

<h1><?php echo metadata('item', 'rich_title', array('no_escape' => true)); ?></h1>

<?php if ($hasVisualMedia): ?>
<?php echo centerrow_output_lightgallery($visualMedia); ?>
<?php endif; ?>

<?php if ((count($otherFiles) > 0) && get_theme_option('other_media') == 0): ?>
    <?php foreach ($otherFiles as $nonImage): ?>
        <?php echo file_markup($nonImage); ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php echo all_element_texts('item'); ?>

<!-- If the item belongs to a collection, the following creates a link to that collection. -->
<?php if (metadata('item', 'Collection Name')): ?>
<div id="collection" class="element">
    <h3><?php echo __('Collection'); ?></h3>
    <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
</div>
<?php endif; ?>

<!-- The following prints a list of all tags associated with the item -->
<?php if (metadata('item', 'has tags')): ?>
<div id="item-tags" class="element">
    <h3><?php echo __('Tags'); ?></h3>
    <div class="element-text"><?php echo tag_string('item'); ?></div>
</div>
<?php endif;?>

<?php if ((count($otherFiles) > 0) && get_theme_option('other_media') == 1): ?>
<div id="other-media" class="element">
    <h3><?php echo __('Files'); ?></h3>
    <?php foreach ($otherFiles as $nonImage): ?>
    <?php $fileLink = ($linkToFileMetadata == '1') ? record_url($nonImage) : $nonImage->getWebPath('original'); ?>
    <div class="element-text"><a href="<?php echo $fileLink; ?>"><?php echo metadata($nonImage, 'rich_title', array('no_escape' => true)); ?> - <?php echo $nonImage->mime_type; ?></a></div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- The following prints a citation for this item. -->
<div id="item-citation" class="element">
    <h3><?php echo __('Citation'); ?></h3>
    <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
</div>

<div id="item-output-formats" class="element">
    <h3><?php echo __('Output Formats'); ?></h3>
    <div class="element-text"><?php echo output_format_list(); ?></div>
</div>

<?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>

<nav>
<ul class="item-pagination navigation">
    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
</ul>
</nav>

<?php echo foot(); ?>
