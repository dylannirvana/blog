<?php

/**
 * Description of MCAddressElement
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
class Forms_Plain_AddressElement extends Forms_ElementsAbstract {

    public function toString() {
        $str = '';
        $str .= ($this->get_before() ? $this->get_before() : '');
        $str .= ($this->get_label() ? '<label>' . $this->get_label() . '</label>' : '');

        $str .= '<fieldset>';
        $str .= '<input class="address-line1" type="text" ' .
                ($this->get_id() ? 'id="' . $this->get_id() . '-addr1" ' : '') .
                ($this->get_name() ? 'name="' . $this->get_name() . '[addr1]" ' : '') .
                'placeholder="Address Line 1"' . (is_array($this->get_attributes()) ?
                        implode(' ', $this->get_attributes()) : '');
        $str .= '/>';
        $str .= '<input class="address-line2" type="text" ' .
                ($this->get_id() ? 'id="' . $this->get_id() . '-addr2" ' : '') .
                ($this->get_name() ? 'name="' . $this->get_name() . '[addr2]" ' : '') .
                'placeholder="Address Line 2"' . (is_array($this->get_attributes()) ?
                        implode(' ', $this->get_attributes()) : '');
        $str .= '/>';
        $str .= '<input class="address-city" type="text" ' .
                ($this->get_id() ? 'id="' . $this->get_id() . '-city" ' : '') .
                ($this->get_name() ? 'name="' . $this->get_name() . '[city]" ' : '') .
                'placeholder="City"' . (is_array($this->get_attributes()) ?
                        implode(' ', $this->get_attributes()) : '');
        $str .= '/>';
        $str .= '<input class="address-state" type="text" ' .
                ($this->get_id() ? 'id="' . $this->get_id() . '-state" ' : '') .
                ($this->get_name() ? 'name="' . $this->get_name() . '[state]" ' : '') .
                'placeholder="State" maxlength="2" size="2" ' . (is_array($this->get_attributes()) ?
                        implode(' ', $this->get_attributes()) : '');
        $str .= '/>';
        $str .= '<input class="address-zip" type="text" ' .
                ($this->get_id() ? 'id="' . $this->get_id() . '-zip" ' : '') .
                ($this->get_name() ? 'name="' . $this->get_name() . '[zip]" ' : '') .
                'placeholder="Zip" maxlength="10" pattern="\d{5}|\d{5}[\-]{1}\d{4}" ' .
                (is_array($this->get_attributes()) ?
                        implode(' ', $this->get_attributes()) : '');
        $str .= '/>';
        $str .= '</fieldset>';
        $str .= ($this->get_after() ? $this->get_after() : '');

        return $str;
    }

}