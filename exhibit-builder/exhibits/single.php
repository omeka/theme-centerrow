<div class="exhibit record">
    <?php if ($exhibitImage = record_image($exhibit, 'fullsize')): ?>
        <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
    <?php endif; ?>
    <div class="featured-meta">
    <h3><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></h3>
    <p><?php echo snippet_by_word_count(metadata($exhibit, 'description', array('no_escape' => true))); ?></p>
    </div>
</div>
