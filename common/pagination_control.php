<?php
if ($this->pageCount > 1):
    $getParams = $_GET;
?>
<nav class="pagination-nav" aria-label="<?php echo __('Pagination'); ?>">
    <form action="<?php echo html_escape($this->url()); ?>" method="get" accept-charset="utf-8">
    <?php
    $hiddenParams = array();
    $entries = explode('&', http_build_query($getParams));
    foreach ($entries as $entry) {
        if (!$entry) {
            continue;
        }
        list($key, $value) = explode('=', $entry);
        $hiddenParams[urldecode($key)] = urldecode($value);
    }

    foreach ($hiddenParams as $key => $value) {
        if ($key != 'page') {
            echo $this->formHidden($key, $value, array('id' => ''));
        }
    }

    // Manually create this input to allow an omitted ID
    $pageInput = '<label>'
                . __('Page') 
                . '<input type="text" name="page" title="'
                . html_escape(__('Current Page'))
                . '" value="'
                . html_escape($this->current) . '">'
                . '</label>';
    echo __('%s of %s', $pageInput, $this->last);
    ?>
    </form>

    <div class="pagination-buttons">
        <?php if (isset($this->previous)): ?>
        <!-- Previous page link -->
            <?php $getParams['page'] = $previous; ?>
            <a class="previous o-icon-previous button" rel="prev" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>" title="<?php echo __('Previous Page'); ?>"></a>
        <?php endif; ?>

        <?php if (isset($this->next)): ?>
        <!-- Next page link -->
            <?php $getParams['page'] = $next; ?>
            <a class="next o-icon-next button" rel="next" href="<?php echo html_escape($this->url(array(), null, $getParams)); ?>" title="<?php echo __('Next Page'); ?>"></a> 
        <?php endif; ?>
    </div>
</nav>

<?php endif; ?>
