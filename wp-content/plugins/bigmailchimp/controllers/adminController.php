<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$bigMailChimpOptions = bigMailChimp_get_options();
$messages = array();
$message_type = '';

if (!empty($_POST)) {
    if (isset($_POST['load_script'])) {
        $bigMailChimpOptions['load_script'] = stripslashes(trim(strip_tags($_POST['load_script'])));
    } else {
        $bigMailChimpOptions['load_script'] = 0;
    }
    if (isset($_POST['load_css'])) {
        $bigMailChimpOptions['load_css'] = stripslashes(trim(strip_tags($_POST['load_css'])));
    } else {
        $bigMailChimpOptions['load_css'] = 0;
    }
    if (isset($_POST['form_layout'])) {
        $bigMailChimpOptions['form_layout'] = stripslashes(trim(strip_tags($_POST['form_layout'])));
    }

    if (!update_option('bigMailChimp_options', $bigMailChimpOptions)) {
        $messages[] = 'No changes made';
        $message_type = 'update';
    } else {
        $messages[] = 'Options updated';
        $message_type = 'update';
    }
}

include_once plugin_dir_path(__DIR__) . 'views/bigMCSettings.php';