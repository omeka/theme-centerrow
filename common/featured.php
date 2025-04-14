<?php ;
$backgroundFile = $record->getFile(0);
if ($backgroundFile) {
  $background = "background-image:url(" . file_display_url($backgroundFile, 'fullsize') . ")";
} else {
  $background = "background-color: #666";
}
?>

<div class="<?php echo $recordType; ?> record" style="<?php echo $background; ?>">
    <div class="featured-meta">
        <span class="sr-only"><?php echo __('Featured'); ?></span>
        <?php if ($recordType == 'Exhibit'): ?>
            <?php set_current_record('exhibit', $record); ?>
            <span id="slick-slide0<?php echo $slideCount; ?>" class="resource-title"><?php echo link_to_exhibit(); ?></span>
        <?php else: ?>
            <span id="slick-slide0<?php echo $slideCount; ?>" class="resource-title"><?php echo link_to($record, 'show', metadata($record, 'display_title')); ?></span>
            <?php if ($creator = metadata($record, array('Dublin Core', 'Creator'))): ?>
            <span class="creator"><?php echo $creator; ?></span>
            <?php endif; ?>
            <?php if ($date = metadata($record, array('Dublin Core', 'Date'), array('snippet' => 150))): ?>
            <span class="date"><?php echo $date; ?></span>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>