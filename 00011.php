<?php

class Solution {

    /**
     * @param Integer[] $height
     * @return Integer
     */
    function maxArea($height) {
        $max = 0;
        $l = 0;
        $r = count($height) - 1;

        while ($l < $r) {
            $temp_h = $height[$l] > $height[$r] ? $height[$r] : $height[$l];
            $temp_w = $r-$l;
            $temp_area = $temp_h * $temp_w;
            $max = $temp_area > $max ? $temp_area : $max;

            if($height[$l] > $height[$r]) {
                $r--;
            } else {
                $l++;
            }
        }
        return $max;
    }
}