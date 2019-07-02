<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function maxSubArray($nums) {
        $dp[0] = $nums[0];
        for($i=1; $i<count($nums); $i++) {
            $dp[$i] = max([$dp[$i-1]+$nums[$i] , $nums[$i]]); # $dp[$i]第i位的最大子序和
        }

        return max($dp);
    }
}