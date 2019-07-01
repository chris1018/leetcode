<?php
/*
 * 算法解析：
 *
 *
 * */

class Solution {
    /**
     * @param Integer $n
     * @return Integer
     */
    function climbStairs($n) {
        # 动态规划
        $dp[1] = 1;
        $dp[2] = 2;
        for($i=3; $i<=$n; $i++) {
            $dp[$i] = $dp[$i-1] + $dp[$i-2];
        }
        return $dp[$n];
    }

}