<?php

/**
 * Description of MCLayout
 *
 * @author Arian Khosravi <arian@bigemployee.com>, <@ArianKhosravi>
 */
class Forms_MC_Layout implements Forms_FormLayoutInterface {

    public function generateForm(Forms_Form $parent) {
        $elements = $parent->getElements();
        $str = '';
        $str .= '<div class="bigMailChimp-wrapper">' . PHP_EOL;
        $str .= '<div class="result"></div>' . PHP_EOL;
        $str .= '<form class="bigMailChimpForm" ' . ($parent->getFormId() ? 'id="' . $parent->getFormId() : '')
                . '" ' . 'action="' . $parent->getAction() . '" ' .
                'method="' . $parent->getMethod() . '">' . PHP_EOL;
        $str .= '<ul>' . PHP_EOL;
        foreach ($elements as $element) {
            $str.= '<li ' .
                    ($element->get_wrapper_class() ?
                            'class="' . $element->get_wrapper_class() . '"' : '') . '>' . PHP_EOL;
            $str.= $element->toString();
            $str.= '</li>' . PHP_EOL;
        }
        $str .= '</ul>' . PHP_EOL;
        $str .= '<input type="submit" value="' . $parent->getButton_text() . '" class="button" />';
        $str .= '</form>' . PHP_EOL;
        $str .= '</div>' . PHP_EOL;
        return $str;
    }

}
