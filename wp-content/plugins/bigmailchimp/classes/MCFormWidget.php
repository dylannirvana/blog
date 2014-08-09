<?php

/**
 * Description of MCFormWidget
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
class MCFormWidget extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'MCFormWidget', 'BigMailChimp', array('description' => __('Display a MailChimp capture form in widget area', 'text_domain'))
        );
    }

    public function widget($args, $instance) {
        extract($args);
        if (!is_array($instance) || !array_key_exists('list_id', $instance)) {
            return;
        }
        $list_id = strip_tags($instance['list_id']);
        $description = strip_tags($instance['description']);
        $required_fields = strip_tags($instance['required_fields']);
        $MCMapper = new MCListMapper();
        if ($MClist = $MCMapper->find($list_id, new MCList())) {
            $api2 = new MCAPI2_Mailchimp($MClist->getApi_key());
            $list_prop = $api2->lists->getList(array('list_id' => $MClist->getList_id()));
            $form = new Forms_MCGenerated($list_prop['data'][0]['web_id'], BIGMAILCHIMP_URL . "includes/mc.php?id=" . $MClist->getId(), 'post', $MClist->getButton_text(), NULL, array('apiKey' => $MClist->getApi_key(), 'listId' => $MClist->getList_id()));
            if ($before_widget) {
                echo str_replace('class="', 'class="bigmailchimp-widget ', $before_widget);
            } else {
                echo '<div class="bigmailchimp-widget">';
            }
            if (array_key_exists('display_title', $instance)) {
                if ($display_title = strip_tags($instance['display_title'])) {
                    echo $before_title? : '<h3>';
                    echo $display_title;
                    echo $after_title? : '</h3>';
                }
            }
            if ($description) {
                echo '<p>' . $description . '</p>';
            }
            echo $form->print_form($required_fields);
            echo $after_widget? : '</div>';
        }
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $list_id = strip_tags($new_instance['list_id']);
        $MCMapper = new MCListMapper();
        if ($MClist = $MCMapper->find($list_id, new MCList())) {
            $api2 = new MCAPI2_Mailchimp($MClist->getApi_key());
            $list_prop = $api2->lists->getList(array('list_id' => $MClist->getList_id()));
            $instance['list_id'] = $list_id;
            $instance['title'] = strip_tags($list_prop['data'][0]['name']);
        }
        $instance['display_title'] = $new_instance['display_title'];
        $instance['description'] = $new_instance['description'];
        $instance['required_fields'] = $new_instance['required_fields'];
        return $instance;
    }

    public
            function form($instance) {
        $str = '';
        $mcMapper = new MCListMapper();
        $mc_lists = $mcMapper->fetchAll();
        $list_id = isset($instance['list_id']) ? $instance['list_id'] : -1;
        $display_title = isset($instance['display_title']) ? $instance['display_title'] : __('', 'bigmailchimp');
        $title = ($display_title ? $display_title . ' :: ' : '') . (isset($instance['title']) ? $instance['title'] : __('New title', 'bigmailchimp'));
        $description = isset($instance['description']) ? $instance['description'] : __('', 'bigmailchimp');
        $required_fields = isset($instance['required_fields'])?:false;

        $str .= '<input id = "' . $this->get_field_id('title') . '" name = "' . $this->get_field_name('title') .
                '" type = "hidden" value = "' . esc_attr($title) . '" />';

        $str .= '<p><label for="' . $this->get_field_id('display_title') . '">Display Title</label>';
        $str .= '<input id="display-title" name="' . $this->get_field_name('display_title') . '" type="text" class="widefat" value="' . esc_attr($display_title) . '"></p>';
        $str .= '<p><label for="' . $this->get_field_id('description') . '">Description</label>';
        $str .= '<textarea id = "' . $this->get_field_id('description') . '" name = "' . $this->get_field_name('description') .
                '" class="widefat">' . esc_attr($description) . '</textarea></p>';

        $str .= '<p>Select list.</p>';
        $str .= '<p><select name="' . $this->get_field_name('list_id') . '" class="widefat">';
        $str .= '<option value="">Select one...</option>';
        foreach ($mc_lists as $list) {
            $api2 = new MCAPI2_Mailchimp($list->getApi_key());
            $list_prop = $api2->lists->getList(array('list_id' => $list->getList_id()));
            $str .= '<option value="' . $list->getId() . '" ' .
                    ($list_id == $list->getId() ? 'selected="selected"' : '') . '>' .
                    $list_prop['data'][0]['name'] . '</option>';
        }
        $str .= '</select></p>';
        $str .= '<p><label for="' . $this->get_field_id('required_fields') . '"><input type="checkbox" id="'
                . $this->get_field_id('required_fields') . '" name="'
                . $this->get_field_name('required_fields') . '" value="1" ' . checked(esc_attr($required_fields), 1, false) . '/>'
                . 'Display required fields only.'
                . '</p>';
        echo $str;
    }

}
