<?php

$messages = array();
$id = null;
$action = '';
$urlVariables = $_GET;
$api_key = '';
$list_id = '';
$button_text = '';
$double_opt_in = '';

if (!empty($_POST['action'])) {
    $action = strip_tags(trim($_POST['action']));
} elseif (!empty($_GET['action'])) {
    $action = strip_tags(trim($_GET['action']));
} elseif (!empty($_POST['action2'])) {
    $action = strip_tags(trim($_POST['action2']));
} elseif (!empty($_GET['action2'])) {
    $action = strip_tags(trim($_GET['action2']));
}
unset($urlVariables['action']);
unset($urlVariables['action2']);
if (!empty($_GET['id'])) {
    if (is_array($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = strip_tags(trim($_GET['id']));
    }
} elseif (!empty($_POST['id'])) {
    if (is_array($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        $id = strip_tags(trim($_POST['id']));
    }
}
if (!empty($_POST['api-key'])) {
    $api_key = strip_tags(trim($_POST['api-key']));
}
if (!empty($_POST['list-id'])) {
    $list_id = strip_tags(trim($_POST['list-id']));
}
if (!empty($_POST['double-opt-in'])) {
    $double_opt_in = strip_tags(trim($_POST['double-opt-in']));
}
if (!empty($_POST['button-text'])) {
    $button_text = strip_tags(trim($_POST['button-text']));
}

$mcMapper = new MCListMapper();
if ($id && !is_array($id)) {
    $mcList = $mcMapper->find($id, new MCList());
} elseif (is_array($id)) {
    foreach ($id as $i) {
        $mcList[] = $mcMapper->find($i, new MCList());
    }
} else {
    $mcList = new MCList();
}
if ($action == 'add') {
    $mcList->setId($id)
            ->setApi_key($api_key)
            ->setList_id($list_id)
            ->setDouble_opt_in($double_opt_in)
            ->setButton_text($button_text);
    $valid_list = false;
    if($api_key && $list_id){
        $valid_list = true;
    }
    if (!$valid_list || !$mcMapper->save($mcList)) {
        $messages[] = 'Unable to save the new list';
        $message_type = 'error';
    } else {
        $messages[] = 'A new List successfuly added';
        $message_type = 'success';
    }
}
if ($action == 'dodelete') {
    if (is_array($id)) {
        foreach ($id as $i) {
            if (!$mcMapper->remove($i)) {
                $messages[] = 'id: ' . $i . ' not Deleted';
            } else {
                $messages[] = 'id: ' . $i . ' successfully Deleted';
            }
        }
    } else {
        if (!$mcMapper->remove($id)) {
            $messages[] = 'id: ' . $id . ' not Deleted';
        } else {
            $messages[] = 'id: ' . $id . ' successfully Deleted';
        }
    }
    $message_type = 'update';
}

switch ($action) {
    case 'new':
        include_once plugin_dir_path(__DIR__) . 'views/bigMCNew.php';
        break;
    case 'delete':
        include_once plugin_dir_path(__DIR__) . 'views/bigMCDelete.php';
        break;
    default:
        include_once plugin_dir_path(__DIR__) . 'views/bigMC.php';
}