<?php
$title = __('Browse Exhibits');
echo head(array('title' => $title, 'bodyclass' => 'exhibits browse'));
?>
<h1><?php echo $title; ?> <?php echo __('(%s total)', $total_results); ?></h1>
<?php if (count($exhibits) > 0): ?>

<nav class="navigation secondary-nav">
    <?php echo nav(array(
        array(
            'label' => __('Browse All'),
            'uri' => url('exhibits')
        ),
        array(
            'label' => __('Browse by Tag'),
            'uri' => url('exhibits/tags')
        )
    )); ?>
</nav>

<div class="browse-controls">
    <?php echo pagination_links(); ?>
</div>

<div class="records">
    <?php $exhibitCount = 0; ?>
    <?php foreach (loop('exhibit') as $exhibit): ?>
        <?php $exhibitCount++; ?>
        <div class="exhibit hentry <?php if ($exhibitCount%2==1) echo ' even'; else echo ' odd'; ?>">
            <?php 
            $linkContent = '';
            if ($exhibitImage = record_image($exhibit)) {
                $exhibitImageFile = $exhibit->getFile();
                $exhibitImageTitle = metadata($exhibitImageFile, 'rich_title', array('no_escape' => true));
                $linkContent .= record_image($exhibit);
            }
            $linkContent .= metadata($exhibit, 'title', array('no_escape' => true));
            ?>
            <h2><?php echo link_to_exhibit($linkContent); ?></h2>
            <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
            <div class="description"><?php echo $exhibitDescription; ?></div>
            <?php endif; ?>
            <?php if ($exhibitTags = tag_string('exhibit', 'exhibits')): ?>
            <p class="tags"><?php echo $exhibitTags; ?></p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

<div class="browse-controls">
    <?php echo pagination_links(); ?>
</div>

<?php else: ?>
<p><?php echo __('There are no exhibits available yet.'); ?></p>
<?php endif; ?>

<?php echo foot(); ?>
