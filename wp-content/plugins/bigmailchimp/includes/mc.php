<?php

define('WP_USE_THEMES', false);
require_once('../../../../wp-load.php');
include_once '../library/Loader.php';
Loader::init();
$messages = array();
if (!empty($_POST) && !empty($_GET['id'])) {
    $id = strip_tags(trim($_GET['id']));
    $mcMapper = new MCListMapper();
    $mcList = $mcMapper->find($id, new MCList());
    $mcapi2 = new MCAPI2_Mailchimp($mcList->getApi_key());
    $list_prop = $mcapi2->lists->getList(array('list_id' => $mcList->getList_id()));
    $merge_vars = array();
    $group_ids = array();

    if ($list_prop['data'][0]['stats']['grouping_count']) {
        $groupings = $mcapi2->lists->interestGroupings($mcList->getList_id());
        if (is_array($groupings)) {
            foreach ($groupings as $grouping) {
                $group_ids[$grouping['id']] = $grouping['name'];
                $merge_vars['groupings'][] = array('name' => $grouping['name'],
                    'groups' => '');
            }
        }
    }
    $email = strip_tags(trim($_POST['EMAIL']));
    if (!empty($_POST['EMAILTYPE'])) {
        $email_type = strtolower(strip_tags(trim($_POST['EMAILTYPE'])));
        unset($_POST['EMAILTYPE']);
    } else {
        $email_type = 'html';
    }
    unset($_POST['EMAIL']);
    foreach ($_POST as $key => $value) {
        if (array_key_exists($key, $group_ids)) {
            $merge_vars['GROUPINGS'][] = array(
                'id' => $key,
                'name' => $group_ids[$key],
                'groups' => $value);
        } else {
            $merge_vars[$key] = $value;
        }
    }
    try {
//    id, email_address, merge_vars, email_type, double_optin, update_existing, replace_interests, send_welcome
        $subscribed = $mcapi2->lists->subscribe($mcList->getList_id(), array('email' => $email), $merge_vars, $email_type, (bool) trim($mcList->getDouble_opt_in()), true, true, true);
        $messages['status'] = "success";
        $messages[] = "Subscribed - You will receive an email confirmation shortly!";
    } catch (Exception $e) {
        $messages['status'] = "error";
        $messages[] = $e->getMessage();
    }
}
echo json_encode($messages);
exit();
