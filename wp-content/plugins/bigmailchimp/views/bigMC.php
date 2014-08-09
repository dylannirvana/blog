<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="wrap">
    <?php $title = __('BigMailChimp') ?>
    <h2><?php echo $title . ' '; ?>
        <a href="admin.php?page=big-mailchimp&action=new" class="add-new-h2">Add New</a></h2>
    <?php if ($messages && $message_type): ?>
        <?php echo MCGetMessages($messages, $message_type); ?>
    <?php endif; ?>
    <?php
    $mc_lists = $mcMapper->fetchAll();
    $page = 1;
    if (isset($urlVariables['paginator'])) {
        $page = strip_tags($urlVariables['paginator']);
        unset($urlVariables['paginator']);
    }
    $pagedResults = new Paginate_Paginator($mc_lists, 20, $page);
    ?>
    <form action="#" id="sliders-form">
        <div class="tablenav top">
            <?php foreach ($urlVariables as $key => $value): ?>
                <input type="hidden" name="<?php echo strip_tags($key) ?>" value="<?php echo strip_tags($value) ?>" />
            <?php endforeach; ?>
            <div class="alignleft actions">
                <select name="action">
                    <option value="" selected="selected">Bulk Actions</option>
                    <option value="delete">Delete</option>
                </select>
                <input type="submit" class="button-secondary action" value="Apply" />
            </div>
            <?php $pagedResults->setLayout(new Paginate_JumpLayout()); ?>
            <?php echo $pagedResults->getPagedNavigation($urlVariables); ?>
            <br class="clear" />
        </div>

        <table class="wp-list-table widefat">
            <thead>
                <tr>
                    <th scope="col" class="column-cb check-column"><input type="checkbox"/></th>
                    <th scope="col">List Name</th>
                    <th scope="col">Default Form Name</th>
                    <th scope="col">Subscribe Short Url</th>
                    <th scope="col">Subscribers</th>
                    <th scope="col">Date Created</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col" class="column-cb check-column"><input type="checkbox"/></th>
                    <th scope="col" >List Name</th>
                    <th scope="col">Default Form Name</th>
                    <th scope="col">Subscribe Short Url</th>
                    <th scope="col">Subscribers</th>
                    <th scope="col">Date Created</th>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($pagedResults->getPageRows() as $id => $mc_list): ?>
                    <?php
                    $api2 = new MCAPI2_Mailchimp($mc_list->getApi_key());
                    $list_prop = $api2->lists->getList(array('list_id' => $mc_list->getList_id()));
                    ?>
                    <tr <?php echo ($id % 2 == 0 ? 'class="alternate"' : '') ?>>
                        <th class="column-cb check-column"><input type="checkbox" name="id[]" value="<?php echo $mc_list->getId(); ?>" /></th>
                        <td><?php echo $list_prop['data'][0]['name']; ?>
                            <div class="row-actions">
                                <span class="edit">
                                    <a href="admin.php?page=big-mailchimp&action=new&id=<?php echo $mc_list->getId(); ?>" title="Edit this item">Edit</a> |
                                </span>
                                <span class="trash">
                                    <a class="submitdelete" title="Move this item to the Trash" href="admin.php?page=big-mailchimp&action=delete&id=<?php echo $mc_list->getId(); ?>">Delete</a>
                                </span>
                            </div>
                        </td>
                        <td><?php echo $list_prop['data'][0]['default_from_name'] ?></td>
                        <td><?php echo '<a href="' . $list_prop['data'][0]['subscribe_url_short'] . '">' . $list_prop['data'][0]['subscribe_url_short'] . '</a>'; ?></td>
                        <td><?php echo $list_prop['data'][0]['stats']['member_count']; ?></td>
                        <td><?php echo $list_prop['data'][0]['date_created']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <div class="tablenav bottom">

            <div class="alignleft actions">
                <select name='action2'>
                    <option value='' selected='selected'>Bulk Actions</option>
                    <option value='delete'>Delete</option>
                </select>
                <input type="submit" class="button-secondary action" value="Apply" />
            </div>
            <?php $pagedResults->setLayout(new Paginate_NavigationLayout()); ?>
            <?php echo $pagedResults->getPagedNavigation($urlVariables); ?>
            <br class="clear" />
        </div>

    </form>
</div>