<?php
$collectionTitle = metadata('collection', 'rich_title', array('no_escape' => true));
$totalItems = metadata('collection', 'total_items');
?>

<?php echo head(array('title' => $collectionTitle, 'bodyclass' => 'collections show')); ?>

<h1><?php echo $collectionTitle; ?></h1>

<?php echo all_element_texts('collection'); ?>

<div id="collection-items" class="items browse">
    <h2><?php echo __('Collection Items'); ?></h2>
    <?php 
    if ($totalItems > 0) {
        foreach (loop('items') as $item) {
            echo $this->partial('items/browse-single.php', array('item' => $item));
        }
        echo link_to_items_browse(__(plural('View item', 'View all %s items', $totalItems), $totalItems), array('collection' => metadata('collection', 'id')), array('class' => 'view-items-link'));
    } else {
        echo '<p>' . __("There are currently no items within this collection.") . '</p>';
    }
    ?>
</div><!-- end collection-items -->

<?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>

<?php echo foot(); ?>
