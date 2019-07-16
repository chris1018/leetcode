<?php

class Solution {

    /**
     * @param String[] $strs
     * @return String
     */
    function longestCommonPrefix($strs) {
        $res = '';
        for($i=0; $i<strlen($strs[0]); $i++) {
            $_char = $strs[0][$i];
            foreach($strs as $str) {
                if(!isset($str[$i]) || ($str[$i]!=$_char)) {
                    break 2;
                }
            }
            $res .= $_char;
        }

        return $res;
    }
}