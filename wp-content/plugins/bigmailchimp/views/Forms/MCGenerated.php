<?php

class Forms_MCGenerated extends Forms_FormAbstract {

    protected $_apiKey;
    protected $_listId;

    public function setApiKey($_apiKey) {
        $this->_apiKey = $_apiKey;
        return $this;
    }

    public function getApiKey() {
        return $this->_apiKey;
    }

    public function setListId($_listID) {
        $this->_listId = $_listID;
        return $this;
    }

    public function getListId() {
        return $this->_listId;
    }

    public function print_form($required_fields = false) {
        $mcapi2 = new MCAPI2_Mailchimp($this->_apiKey);
        $list = $mcapi2->lists->getList(array('list_id' => $this->_listId));
        $merge_vars = $mcapi2->lists->mergeVars(array('id' => $this->_listId));
        if (is_array($merge_vars) && !empty($merge_vars) &&
                array_key_exists('data', $merge_vars) && is_array($merge_vars['data']) &&
                !empty($merge_vars['data']) && array_key_exists('0', $merge_vars['data']) &&
                is_array($merge_vars['data'][0]) && !empty($merge_vars['data'][0]) &&
                array_key_exists('merge_vars', $merge_vars['data'][0]) &&
                !empty($merge_vars['data'][0]['merge_vars'])) {

            foreach ($merge_vars['data'][0]['merge_vars'] as $index => $form_field) {
                if ($required_fields && !$form_field['req']) {
                    continue;
                } elseif ($form_field['show']) {
                    $class = $this->getForm_layout() . '_' . ucfirst($form_field['field_type']) . 'Element';
                    $attributes = array();
                    if ($form_field['req'])
                        $attributes[] = 'required';

                    $element = new $class(
                            isset($form_field['field_type']) ? $form_field['field_type'] : null, isset($form_field['tag']) ? $form_field['tag'] : null, isset($form_field['tag']) ? $form_field['tag'] : null, isset($form_field['choices']) ? $form_field['choices'] : null, isset($form_field['name']) ? $form_field['name'] : null, $attributes);
                    $this->getForm()->addElement($element);
                }
            }
        }


        if (!$required_fields && $list['data'][0]['stats']['grouping_count']) {
            $groupings = $mcapi2->lists->interestGroupings($this->_listId);
            if (is_array($groupings) && !empty($groupings)) {
                foreach ($groupings as $form_field) {
                    if ($form_field['form_field'] != 'hidden') {
                        $class = $this->getForm_layout() . '_' . ucfirst($form_field['form_field']) . 'Element';
                        $groups = $form_field['groups'];
                        $value = array();
                        foreach ($groups as $group) {
                            $value[] = $group['name'];
                        }

                        $element = new $class(
                                isset($form_field['form_field']) ? $form_field['form_field'] : null, isset($form_field['id']) ? $form_field['id'] : null, isset($form_field['id']) ? $form_field['id'] . '[]' : null, $value, isset($form_field['name']) ? $form_field['name'] : null);
                        $this->getForm()->addElement($element);
                    }
                }
            }
        }

        if ($list['data'][0]['email_type_option']) {
            $values = array('HTML', 'Text', 'Mobile');
            $class = $this->getForm_layout() . '_' . 'RadioElement';
            $element = new $class(
                    'radio', 'EMAILTYPE', 'EMAILTYPE', $values, 'Preferred format');
            $this->getForm()->addElement($element);
        }
        $layoutClass = $this->getForm_layout() . '_Layout';
        return $this->getForm()->generateForm(false, new $layoutClass());
    }

}
