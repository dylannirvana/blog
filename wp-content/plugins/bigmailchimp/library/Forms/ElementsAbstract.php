<?php

/**
 * Description of FormElements
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
abstract class Forms_ElementsAbstract {

    private $_type;
    private $_id;
    private $_name;
    private $_value;
    private $_label;
    private $_attributes;
    private $_before;
    private $_after;
    private $_wrapper_class = '';

    abstract public function toString();

    public function __construct($type, $id, $name, $value, $label = '', array $attributes = array(), $before = '', $after = '', $wrapper_class = '') {
        $this->_type = $type;
        $this->_id = $id;
        $this->_name = $name;
        $this->_value = $value;
        $this->_label = $label;
        $this->_attributes = $attributes;
        $this->_before = $before;
        $this->_after = $after;
        $this->_wrapper_class = $wrapper_class;
    }

    public function get_type() {
        return $this->_type;
    }

    public function set_type($_type) {
        $this->_type = $_type;
        return $this;
    }

    public function get_id() {
        return $this->_id;
    }

    public function set_id($_id) {
        $this->_id = $_id;
        return $this;
    }

    public function get_name() {
        return $this->_name;
    }

    public function set_name($_name) {
        $this->_name = $_name;
        return $this;
    }

    public function get_value() {
        return $this->_value;
    }

    public function set_value($_value) {
        $this->_value = $_value;
        return $this;
    }

    public function get_label() {
        return $this->_label;
    }

    public function set_label($_label) {
        $this->_label = $_label;
        return $this;
    }

    public function get_attributes() {
        return $this->_attributes;
    }

    public function set_attributes($_attributes) {
        $this->_attributes = $_attributes;
        return $this;
    }

    public function get_before() {
        return $this->_before;
    }

    public function set_before($_before) {
        $this->_before = $_before;
        return $this;
    }

    public function get_after() {
        return $this->_after;
    }

    public function set_after($_after) {
        $this->_after = $_after;
        return $this;
    }

    public function get_wrapper_class() {
        return $this->_wrapper_class;
    }

    public function set_wrapper_class($_wrapper_class) {
        $this->_wrapper_class = $_wrapper_class;
        return $this;
    }

}