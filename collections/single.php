<div class="collection record">
    <?php
    $title = metadata($collection, array('Dublin Core', 'Title'));
    $description = metadata($collection, array('Dublin Core', 'Description'), array('snippet' => 150));
    ?>
    <?php if ($collectionImage = record_image($collection, 'fullsize')): ?>
        <?php echo link_to($this->collection, 'show', $collectionImage, array('class' => 'image')); ?>
    <?php endif; ?>
    <div class="featured-meta">
        <h3><?php echo link_to($this->collection, 'show', strip_formatting($title)); ?></h3>
    <?php if ($description): ?>
        <p class="collection-description"><?php echo $description; ?></p>
    <?php endif; ?>
    </div>
</div>
