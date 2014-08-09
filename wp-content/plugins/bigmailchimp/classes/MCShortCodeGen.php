<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MCShortCodeGen
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
class MCShortCodeGen {
    //put your code here

    const LANG = 'BigMailChimp';

    public function __construct() {
        add_action('add_meta_boxes', array(&$this, 'add_BigMailChimp_MetaBox'));
    }

    public function add_BigMailChimp_MetaBox() {
        add_meta_box(
                'BigMailChimp_MetaBox'
                , __('BigMailChimp', self::LANG)
                , array(&$this, 'render_BigMailChimp_MetaBox')
                , 'page'
                , 'side'
        );

        add_meta_box(
                'BigMailChimp_MetaBox'
                , __('BigMailChimp', self::LANG)
                , array(&$this, 'render_BigMailChimp_MetaBox')
                , 'post'
                , 'side'
        );
    }

    public function render_BigMailChimp_MetaBox() {
        $mcMapper = new MCListMapper();
        $mc_lists = $mcMapper->fetchAll();
        $str = '';
        $str .= '<h4>Select the list you want to include on the page/post.</h4>';
        $str .= '<p><select id="BMC-SELECT">';
        $str .= '<option value="">Select one...</option>';
        foreach ($mc_lists as $list) {
            $api2 = new MCAPI2_Mailchimp($list->getApi_key());
            $list_prop = $api2->lists->getList(array('list_id' => $list->getList_id()));
            $str .= '<option value="'.$list->getId().'">'.$list_prop['data'][0]['name'].'</option>';
        }
        $str .= '</select></p>';
        $str .= '<p><label for="BMC-required-fields-only">';
        $str .= '<input type="checkbox" id="BMC-required-fields-only" /> Display required fields only.'
                . '</label></p>';
        $str .= '<p><a id="bigMailChimp-send_to_editor" href="#" class="button">Insert into page</a></p>';
        echo $str;
    }

}