<?php
/* @var $container Zend\Navigation\Navigation */
$container = $this->container;
$layout = $this->navigation()->menu()->getUlClass();
?>
<ul class="navigation">
    <?php foreach ($container as $page): ?>
        <?php if (!$this->navigation()->accept($page)) continue; ?>
        <?php /* @var $page Zend\Navigation\Page\Mvc */ ?>
        <?php $hasChildren = $page->hasPages() ?>
        <?php $showChildren = get_theme_option('nav_show_levels'); ?>
        <li class="<?php if ($page->isActive()) echo 'active' ?>">
            <a href="<?php echo ($hasChildren) ? '#' : $page->getHref(); ?>">
                <?php echo html_escape($this->translate($page->getLabel())); ?>
            </a>
            <?php 
            if (!$hasChildren || ($showChildren !== 0)) {
                $access = false;
                foreach ($page->getPages() as $child) {
                    if ($this->navigation()->accept($child) && $child->get("separator") !== true) {
                        $access = true;
                    }
                }
                if ($access) {
                    echo '<div class="sub-nav first"><ul><li class="sub-nav-group">';
                    echo '<a href="' . $page->getHref() . '" class="parent">' . html_escape($this->translate($page->getLabel())) . '</a>';
                    echo ($access) ? $this->partial('sub-navigation.php', ['container'=> $container, 'children' => $page->getPages()]) : '';
                    echo '</li></ul></div>';
                }
            }
            ?>
        </li>
    <?php endforeach ?>
</ul>