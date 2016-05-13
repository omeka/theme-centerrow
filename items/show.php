<?php
queue_css_file('chocolat');
queue_js_file('jquery.chocolat.min', 'js');
queue_js_string('
    jQuery(document).ready(function(){
        var inContainer = jQuery("#itemfiles-nav").Chocolat({
        imageSize: "default",
        loop: true,
        fullscreen: true,
        container: "#itemfiles"
        }).data("chocolat");

        inContainer.api().open()
    });
');
echo head(array('title' => metadata('item', array('Dublin Core', 'Title')), 'bodyclass' => 'items show'));
$itemFiles = $item->Files;
?>

<h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>

<!-- The following returns all of the files associated with an item. -->
<?php if (metadata('item', 'has files')): ?>
<div id="itemfiles" style="width: 100%; height: 50vh; background: #E0E0E0; margin:auto;"></div>
<div id="itemfiles-nav">
    <?php foreach ($itemFiles as $itemFile): ?>
        <a href="<?php echo $itemFile->getWebPath('original'); ?>" class="chocolat-image">
            <?php echo file_image('square_thumbnail', array(), $itemFile); ?>
        </a>
    <?php endforeach; ?>
</div>
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
