<?php

/**
 * Description of MCPhoneElement
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
class Forms_Plain_PhoneElement extends Forms_ElementsAbstract {

    public function toString() {
        $str = '';
        $str .= ($this->get_before() ? $this->get_before() : '');
        $str .= ($this->get_label() ? '<label>' .
                        $this->get_label() . '</label>' : '');
        $str .= '<span>(</span>';
        $str .= '<input type="text" ' .
                ($this->get_id() ? 'id="' . $this->get_id() . '-area" ' : '') .
                ($this->get_name() ? 'name="' . $this->get_name() . '[area]" ' : '') .
                ($this->get_value() ? 'value="' . $this->get_value() . '" ' : '') .
                'pattern="[0-9]*" maxlength="3" size="3" ' .
                (is_array($this->get_attributes()) ?
                        implode(' ', $this->get_attributes()) : '');
        $str .= ' class="tel-area" />';
        $str .= '<span>)</span>';
        $str .= '<input type="text" ' .
                ($this->get_id() ? 'id="' . $this->get_id() . '-detail1" ' : '') .
                ($this->get_name() ? 'name="' . $this->get_name() . '[detail1]" ' : '') .
                ($this->get_value() ? 'value="' . $this->get_value() . '" ' : '') .
                'pattern="[0-9]*" maxlength="3" size="3" ' .
                (is_array($this->get_attributes()) ?
                        implode(' ', $this->get_attributes()) : '');
        $str .= ' class="tel-3" />';
        $str .= '<span>-</span>';
        $str .= '<input type="text" ' .
                ($this->get_id() ? 'id="' . $this->get_id() . '-detail2" ' : '') .
                ($this->get_name() ? 'name="' . $this->get_name() . '[detail2]" ' : '') .
                ($this->get_value() ? 'value="' . $this->get_value() . '" ' : '') .
                'pattern="[0-9]*" maxlength="4" size="4" ' .
                (is_array($this->get_attributes()) ?
                        implode(' ', $this->get_attributes()) : '');
        $str .= ' class="tel-4" />';
        $str .= ($this->get_after() ? $this->get_after() : '');

        return $str;
    }

}