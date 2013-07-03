<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form_util
 *
 * @author Dark
 */
class Form_util {

    //put your code here


    public static function dropdownfromlist($name, $list, $template, $selected, $extra) {
        $CI =&get_instance(); 
        $CI->load->helper('form');
        $CI->load->library('parser');
        $array = array();
        if (count($template)>=2) {
            foreach ($list as $value) {
               $valuetemplate = $CI->parser->parse_string( $template[0], get_object_vars($value), true);
               $texttemplate = $CI->parser->parse_string( $template[1], get_object_vars($value), true);
                $array[$valuetemplate] = $texttemplate;
            }
            return form_dropdown($name, $array, $selected,$extra);
        }
        return null;
    }

}

?>
