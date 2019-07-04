<?php
/*
 * 算法解析--滑动窗口
 *
 * */
class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function lengthOfLongestSubstring($s) {
        $arr = [];
        $max_len = 0;
        for($i=0,$j=0; $j<strlen($s); $j++) {
            $temp = $s[$j];
            if(isset($arr[$temp])) {
                $i = max([$arr[$temp], $i]); // 滑动窗口到该元素上一次出现的位置的+1的地方
            }
            $max_len = max([$max_len, $j-$i+1]);
            $arr[$temp] = $j+1; //元素=》出现的位置的后一个
        }

        return $max_len;
    }
}