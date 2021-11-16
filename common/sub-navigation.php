    <ul>
        <?php foreach ($children as $child): ?>
            <?php $hasChildren = $child->hasPages() ?>
            <?php if (!$this->navigation()->accept($child)) continue; ?>
            <?php if ($child->get("separator") === true): ?>
                <li class="divider"></li>
            <?php
                continue;
            endif;
            ?>

            <?php if (!$hasChildren): ?>
                <li class="<?php if ($child->isActive()) echo ' active' ?>">
                    <a

                        href="<?php echo $child->getHref() ?>"
                        <?php if ($child->getTarget() != ""): ?>
                            target="<?php echo $child->getTarget(); ?>"
                        <?php endif; ?>
                        >
                            <?php if ($child->get("icon") !== ""): ?>
                            <span class="<?php echo $child->get("icon"); ?>"></span>
                        <?php endif; ?>
                        <?php echo html_escape($this->translate($child->getLabel())); ?>
                    </a>
                </li>
            <?php else:?>

                <?php
                    //check if access is allowed at least one item
                    $access = false;
                    foreach ($child->getPages() as $grandChild) {
                        if ($this->navigation()->accept($grandChild) && $grandChild->get("separator") !== true) {
                            $access = true;
                        }
                    }
                    if ($access) :
                        ?>

                    <li<?php if ($child->isActive()) echo ' class="active"' ?>>
                        <a
                            href="<?php echo $child->getHref() ?>"
                            <?php if ($child->getTarget() != ""): ?>
                                target="<?php echo $child->getTarget(); ?>"
                            <?php endif; ?> >
                                <?php if ($child->get("icon") !== ""): ?>
                                <span class="<?php echo $child->get("icon"); ?>"></span>
                            <?php endif; ?>
                            <?php echo $this->escapeHtml($this->translate($child->getLabel(),$this->navigation($container)->getTranslatorTextDomain())); ?>
                        </a>
                        <?php if ($hasChildren && ($navDepthSetting == 0 || $level < $navDepthSetting)): ?>
                            <?php echo $this->partial('common/sub-navigation', ['container'=> $container, 'children' => $child->getPages(), 'level' => ($level + 1)]); ?>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
