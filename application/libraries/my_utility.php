<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class My_Utility designed to format text articles
 */
class My_Utility {
    public static function convertToParas($text){
        $text = trim($text);
        return '<p>' . preg_replace('/[\r\n]+/','</p><p>',$text) . '</p>';
    }

    public static function getFirst($text, $number=2) {
        $sentences = preg_split('/([.?!]["\']?\s)/', $text, $number+1, PREG_SPLIT_DELIM_CAPTURE);
        if (count($sentences) > $number * 2) {
            $remainder = array_pop($sentences);
        } else {
            $remainder = '';
        }
        $result = array();
        $result[0] = implode('', $sentences);
        $result[1] = $remainder;
        return $result;
    }
}