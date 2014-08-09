<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="wrap">
    <?php $title = __('Remove MailChimp List') ?>
    <h2><?php echo $title . ' '; ?></h2>

    <?php if ($messages && $message_type): ?>
        <?php echo MCGetMessages($messages, $message_type); ?>
    <?php endif; ?>
    <h3>Are you sure you want to remove the following list(s)?</h3>
    <?php if (is_array($mcList)): ?>
        <?php foreach ($mcList as $mcL): ?>
            <p><span>Api Key: <?php echo $mcL->getApi_key(); ?></span> <span>List Id: <?php echo $mcL->getList_id(); ?></span></p>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Api Key: <?php echo $mcList->getApi_key(); ?></p>
        <p>List Id: <?php echo $mcList->getList_id(); ?></p>
    <?php endif; ?>
    <form id="add-list" method="post" action="admin.php?page=big-mailchimp&action=dodelete">
        <?php if (is_array($id)): ?>
            <?php foreach ($id as $i): ?>
                <input type="hidden" name="id[]" value="<?php echo $i ?>" />
            <?php endforeach; ?>
        <?php else: ?>
            <input type="hidden" name="id" value="<?php echo $id ?>" />
        <?php endif; ?>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Delete"></p>
    </form>
</div>