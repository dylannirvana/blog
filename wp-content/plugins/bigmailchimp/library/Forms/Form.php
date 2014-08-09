<?php

/**
 * Description of FormGen
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
class Forms_Form {

    protected $_form_id;
    protected $_action;
    protected $_method;
    protected $_form_elements;
    protected $_layout;
    protected $button_text;

    public function __construct($form_id, $action = '', $method = 'post', $button_text = 'Subscribe to list', $layout = null) {
        $this->_form_id = $form_id;
        $this->_action = $action;
        $this->_method = $method;
        $this->_form_elements = array();
        $this->_layout = $layout;
        $this->button_text = $button_text;
    }

    public function setFormId($form_id) {
        $this->_form_id = $form_id;
        return $this;
    }

    public function getFormId() {
        return $this->_form_id;
    }

    public function setAction($action) {
        $this->_action = $action;
        return $this;
    }

    public function getAction() {
        return $this->_action;
    }

    public function setMethod($method) {
        $this->_method = $method;
        return $this;
    }

    public function getMethod() {
        return $this->_method;
    }

    public function getElements() {
        return $this->_form_elements;
    }

    public function setElements($elements) {
        $this->_form_elements = $elements;
        return $this;
    }

    public function getButton_text() {
        return $this->button_text;
    }

    public function setButton_text($button_text) {
        $this->button_text = $button_text;
        return $this;
    }

    public function getLayout() {
        return $this->_layout;
    }

    public function setLayout($layout) {
        $this->_layout = $layout;
    }

    public function addElement(Forms_ElementsAbstract $element) {
        $this->_form_elements[] = $element;
    }

    public function generateForm($echo = true, $layout = null) {
        if ($layout)
            $this->setLayout($layout);
        if (!$echo)
            return $this->getLayout()->generateForm($this);
        echo $this->getLayout()->generateForm($this);
    }

}
