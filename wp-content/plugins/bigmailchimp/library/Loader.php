<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Loader
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
class Loader {

    public static $instance;
    private $_src = array('library/', 'views/', 'models/', 'classes/');
    private $_ext = array('.php', '.class.php');

    public static function init() {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        spl_autoload_register(array($this, 'loader'));
    }

    protected function loader($class_name) {
        $docroot = str_replace(DIRECTORY_SEPARATOR . 'library', '', dirname(__FILE__)) . DIRECTORY_SEPARATOR;
        $class = str_replace('_', '/', $class_name);
        $file = '';
        foreach ($this->_src as $resource) {
            foreach ($this->_ext as $ext) {
                $file = $docroot . $resource . $class . $ext;
                if (file_exists($file)) {
                    require_once $file;
                    break;
                }
            }
            if (file_exists($file)) {
                break;
            }
        }
    }

}
