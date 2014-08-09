<?php

/**
 * Description of MCImageurlElement
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
class Forms_MC_ImageurlElement extends Forms_ElementsAbstract {

    public function toString() {
        $str = '';
        $str .= ($this->get_before() ? $this->get_before() : '');
//        $str .= ($this->get_label() ? '<label for="' . $this->get_id() . '">' .
//                        $this->get_label() . '</label>' : '');
        $str .= '<input class="input-url" type="url" ' .
                ($this->get_id() ? 'id="' . $this->get_id() . '" ' : '') .
                ($this->get_name() ? 'name="' . $this->get_name() . '" ' : '') .
                ($this->get_value() ? 'value="' . $this->get_value() . '" ' : '') .
                'placeholder="' . $this->get_label() . '" ' .
                (is_array($this->get_attributes()) ?
                        implode(' ', $this->get_attributes()) : '');
        $str .= '/>';
        $str .= ($this->get_after() ? $this->get_after() : '');

        return $str;
    }

}