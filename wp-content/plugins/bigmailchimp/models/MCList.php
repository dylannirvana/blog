<?php

/**
 * Description of MCList
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
class MCList {

    protected $id;
    protected $api_key;
    protected $list_id;
    protected $double_opt_in;
    protected $button_text;

    function __construct(array $options = null) {
        if (is_array($options))
            $this->setOptions($options);
    }

    function __set($name, $value) {
        $method = 'set' . $name;
        if ('mapper' == $name || !method_exists($this, $method))
            throw new Exception('Invalid method ' . $method);

        $this->$method($value);
    }

    function __get($name) {
        $method = 'get' . $name;
        if ('mapper' == $name || !method_exists($this, $method))
            throw new Exception('Invalid method ' . $method);

        return $this->$method();
    }

    function setOptions(array $options = null) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods))
                $this->$method($value);
        }
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getApi_key() {
        return $this->api_key;
    }

    public function setApi_key($api_key) {
        $this->api_key = $api_key;
        return $this;
    }

    public function getList_id() {
        return $this->list_id;
    }

    public function setList_id($list_id) {
        $this->list_id = $list_id;
        return $this;
    }

    public function getDouble_opt_in() {
        return $this->double_opt_in;
    }

    public function setDouble_opt_in($double_opt_in) {
        $this->double_opt_in = $double_opt_in;
        return $this;
    }

    public function getButton_text() {
        return $this->button_text;
    }

    public function setButton_text($button_text) {
        $this->button_text = $button_text;
        return $this;
    }

}