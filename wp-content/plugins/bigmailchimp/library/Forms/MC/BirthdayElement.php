<?php

/**
 * Description of MCBirthdayElement
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
class Forms_MC_BirthdayElement extends Forms_ElementsAbstract {

    public function toString() {
        $str = '';
        $str .= ($this->get_before() ? $this->get_before() : '');
        $str .= ($this->get_label() ? '<label>' .
                        $this->get_label() . '</label>' : '');
        $str .= '<input type="text" ' .
                ($this->get_name() ? 'name="' . $this->get_name() . '[month]" ' : '') .
                'pattern="[0-9]*" size="2" maxlength="2" placeholder="MM" ' .
                ($this->get_value() ? 'value="' . $this->get_value() . '" ' : '') .
                (is_array($this->get_attributes()) ?
                        implode(' ', $this->get_attributes()) : '');
        $str .= ' class="date-mm" />';
        $str .= '<span> / </span>';
        $str .= '<input type="text" ' .
                ($this->get_name() ? 'name="' . $this->get_name() . '[day]" ' : '') .
                'pattern="[0-9]*" size="2" maxlength="2" placeholder="DD" ' .
                ($this->get_value() ? 'value="' . $this->get_value() . '" ' : '') .
                (is_array($this->get_attributes()) ?
                        implode(' ', $this->get_attributes()) : '');
        $str .= ' class="date-dd" />';
        $str .= ($this->get_after() ? $this->get_after() : '');

        return $str;
    }

}