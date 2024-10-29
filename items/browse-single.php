    <div class="item hentry">
        <div class="item-meta">
        <?php 
        $linkContent = '';
        if (metadata('item', 'has files')) {
            $itemImageFile = $item->getFile(0);
            $itemImageTitle = metadata($itemImageFile, 'rich_title', array('no_escape' => true));
            $linkContent .= item_image();
        }
        $linkContent .= metadata($item, 'rich_title', array('no_escape' => true));
        ?>

        <h2><?php echo link_to_item($linkContent, array('class'=>'permalink')); ?></h2>

        <?php if ($creator = metadata('item', array('Dublin Core', 'Creator'))): ?>
        <span class="creator"><?php echo $creator; ?></span>
        <?php endif; ?>
        <?php if ($date = metadata('item', array('Dublin Core', 'Date'))): ?>
        <span class="date"><?php echo $date; ?></span>
        <?php endif; ?>

        <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>

        </div><!-- end class="item-meta" -->
    </div><!-- end class="item hentry" -->
