<?php
$pageTitle = __('Browse Collections');
echo head(array('title'=>$pageTitle,'bodyclass' => 'collections browse'));
?>

<h1><?php echo $pageTitle; ?> <?php echo __('(%s total)', $total_results); ?></h1>

<div class="browse-controls">
    <?php
    $sortLinks[__('Title')] = 'Dublin Core,Title';
    $sortLinks[__('Date Added')] = 'added';
    ?>
    <div id="sort-links">
        <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
    </div>

    <?php echo pagination_links(); ?>
</div>

<div class="records">
<?php foreach (loop('collections') as $collection): ?>
    <div class="collection hentry">

        <?php
        $linkContent = '';
        if ($collectionImage = record_image('collection')) {
            $collectionImageFile = $collection->getFile();
            $collectionImageTitle = metadata($collectionImageFile, 'rich_title', array('no_escape' => true));
            $linkContent .= record_image('collection', null, array('alt' => '', 'title' => $collectionImageTitle));
        }
        $linkContent .= metadata($collection, 'rich_title', array('no_escape' => true));
        ?>

        <h2><?php echo link_to_collection($linkContent); ?></h2>

        <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
        <div class="description">
            <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet'=>150))); ?>
        </div>
        <?php endif; ?>

        <?php if ($collection->hasContributor()): ?>
        <div class="collection-contributors">
            <p>
            <strong><?php echo __('Contributors'); ?>:</strong>
            <?php echo metadata('collection', array('Dublin Core', 'Contributor'), array('all'=>true, 'delimiter'=>', ')); ?>
            </p>
        </div>
        <?php endif; ?>

        <?php echo link_to_items_browse(__('View the items in %s', metadata('collection', 'rich_title', array('no_escape' => true))), array('collection' => metadata('collection', 'id')), array('class' => 'view-items-link')); ?>

        <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>

    </div><!-- end class="collection" -->
<?php endforeach; ?>
</div>

<div class="browse-controls">
    <?php echo pagination_links(); ?>
</div>

<?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>

<?php echo foot(); ?>
