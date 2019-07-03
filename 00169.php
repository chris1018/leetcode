<?php
/**
 */
# 哈希表
class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function majorityElement($nums) {
        $res = []; # 记录元素出现的次数
        $max = 0; # 中位数出现的次数
        $max_pos = 0; # 中位数的位置
        for($i=0; $i<count($nums); $i++) {
            if(isset($res[$nums[$i]])) {
                $res[$nums[$i]]++;
            } else {
                $res[$nums[$i]] = 1;
            }
            if($max < $res[$nums[$i]]) {
                $max = $res[$nums[$i]];
                $max_pos = $i;
            }
        }

        return $nums[$max_pos];
    }
}

# 分治法
class Solution2 {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function majorityElement($nums) {
        return $this->findMajorityElement($nums, 0, count($nums)-1);
    }

    function findMajorityElement(array $nums, int $l, int $r) {
        echo $l. '--'. $r . '/n';
        if($l >= $r) {
            return $nums[$r];
        }
        $mid = intval(($l+$r)/2);
        $l_major = $this->findMajorityElement($nums, $l, $mid);
        $r_major = $this->findMajorityElement($nums, $mid+1, $r);
        if($l_major != $r_major) {
            $l_count =  $this->caclOcurTimes($nums, $l, $mid, $l_major);
            $r_count =  $this->caclOcurTimes($nums, $mid+1, $r, $r_major);
            return $l_count > $r_count ? $l_major: $r_major;
        }else {
            return $r_major;
        }
    }

    # 計算元素 $num 在數組 $nums 從下標 $l 到下標 $r 中出現的次數，
    function caclOcurTimes(array $nums, int $l, int $r, int $num) {
        $count = 0;
        for($i=$l; $i<=$r; $i++) {
            if($nums[$i] == $num) {
                $count++;
            }
        }
        return $count;
    }
}

# Boyer-Moore 投票算法
class Solution3 {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function majorityElement($nums) {
        $count = 0;
        $major = $nums[0];
        for($i=0; $i<count($nums); $i++) {
            if($count == 0) {
                $major = $nums[$i];
            }
            if($major == $nums[$i]) {
                $count++;
            } else {
                $count--;
            }
        }
        return $major;
    }
}
