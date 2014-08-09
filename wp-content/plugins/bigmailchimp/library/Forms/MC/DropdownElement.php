<?php

/**
 * Description of MCDropdownElement
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
class Forms_MC_DropdownElement extends Forms_ElementsAbstract {

    public function toString() {
        $values = $this->get_value();
        $str = '';
        $str .= ($this->get_before() ? $this->get_before() : '');
        $str .= ($this->get_label() ? '<label for="' . $this->get_id() . '">' .
                        $this->get_label() . '</label>' : '');
        $str .= '<fieldset>';
        $str .= '<select '.
                ($this->get_id() ? 'id="' . $this->get_id() . '" ' : '') .
                ($this->get_name() ? 'name="' . $this->get_name() . '" ' : '') .
                (is_array($this->get_attributes()) ?
                        implode(' ', $this->get_attributes()) : '') . ' >';
        $str .= '<option value="">Select One...</option>';
        foreach ($values as $index => $value) {
            $str .= '<option value="' . $value . '">' . $value . '</option>';
        }
        $str .= '</select>';
        $str .= ($this->get_after() ? $this->get_after() : '');
        $str .= '</fieldset>';
        return $str;
    }

}