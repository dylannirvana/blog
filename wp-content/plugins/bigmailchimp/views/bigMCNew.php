<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="wrap">
    <?php $title = __('Add a New MailChimp List') ?>
    <h2><?php echo $title . ' '; ?></h2>

    <?php if ($messages && $message_type): ?>
        <?php echo MCGetMessages($messages, $message_type); ?>
    <?php endif; ?>
    <form id="add-list" method="post" action="admin.php?page=big-mailchimp&action=add">
        <input type="hidden" name="id" value="<?php echo $id ?>" />
        <h3>Create a new capture form:</h3>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="api-key">MailChimp Api Key</label><br /><span class="description">API Key - see <a href="http://admin.mailchimp.com/account/api" target="_blonk">http://admin.mailchimp.com/account/api</a></span></th>
                <td><input type="text" name="api-key" id="api-key" class="regular-text" value="<?php echo $mcList->getApi_key(); ?>"/></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="list-id">MailChimp List Id</label><br /><span class="description">Login to your MC account, go to `List > Settings > List name & defaults`, and look for the `List ID`</span></th>
                <td><input type="text" name="list-id" id="list-id" class="regular-text" value="<?php echo $mcList->getList_id(); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="button-text">Submit Button Text</label></th>
                <td><input type="text" name="button-text" id="button-text" class="regular-text" value="<?php echo $mcList->getButton_text()?:'Subscribe to list'; ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="double-opt-in">Double Opt In</label></th>
                <td><label for="double-opt-in"><input type="checkbox" name="double-opt-in" id="double-opt-in" value="1" <?php checked((int)(is_null($mcList->getDouble_opt_in())?1:$mcList->getDouble_opt_in()), 1) ?>/> When your subscriber checks their inbox, they'll see an email with a link to confirm their subscription. If they don't click this link, they won't be added to your list.</label></td>
            </tr>
        </table>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"></p>
    </form>
</div>