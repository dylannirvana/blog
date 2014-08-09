<?php

if (!function_exists('MCGetMessages')) {

    function MCGetMessages($messages, $message_type) {
        $str = '';
        if (count($messages) > 0) {
            if ($message_type == 'error') {
                $str .= '<div class="box_error"><p>';
                foreach ($messages as $message) {
                    $str.= $message . '<br>';
                }
                $str .= '</p></div>';
            } elseif ($message_type == 'update') {
                $str .= '<div class="box_update"><p>';
                foreach ($messages as $message) {
                    $str .= $message . '<br>';
                }
                $str .= '</p></div>';
            } elseif ($message_type == 'success') {
                $str .= '<div id="message" class="box_success"><p>';
                foreach ($messages as $message) {
                    $str .= $message . '<br>';
                }
                $str .= '</p></div>';
            }
        }
        return $str;
    }

}

function bigMailChimp_default_settings() {
    $default_options = array(
        'load_script' => true,
        'load_css' => true,
        'form_layout' => 'Forms_Plain',
    );
    return apply_filters('bigMailChimp_default_settings', $default_options);
}

function bigMailChimp_get_options() {
    return get_option('bigMailChimp_options', bigMailChimp_default_settings());
}
