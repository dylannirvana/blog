<?php

/**
 * Description of FormInterface
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
abstract class Forms_FormAbstract {

    protected $_form;
    protected $form_layout;

    abstract public function print_form($required_fields = false);

    public function __construct($form_id, $action = '', $method = 'post',
            $button_text = 'Subscribe to list', $layout = null, array $options = null) {
        $this->_form = new Forms_Form($form_id, $action, $method, $button_text, $layout);
        if (is_array($options)) {
            $this->setOptions($options);
        }
        $bigMailChimpOptions = bigMailChimp_get_options();
        $this->form_layout = $bigMailChimpOptions['form_layout'];
    }

    public function __get($name) {
        $method = 'get' . $name;
        if ("mapper" == $name || !method_exists($this, $method)) {
            throw new Exception('call to invalid method ' . $method);
        }
        return $this->$method();
    }

    public function __set($name, $value) {
        $method = 'set' . $name;
        if ('mapper' == $name || !method_exists($this, $method)) {
            throw new Exception('call to invalid method ' . $method);
        }
        $this->$method($value);
    }

    public function setOptions(array $options = NULL) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function getForm() {
        return $this->_form;
    }

    public function getForm_layout() {
        return $this->form_layout;
    }

    public function setForm_layout($form_layout) {
        $this->form_layout = $form_layout;
        return $this;
    }



}
