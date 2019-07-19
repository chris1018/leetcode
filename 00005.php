<?php

# 暴力法
class Solution {

    /**
     * @param String $s
     * @return String
     */
    function longestPalindrome($s) {
        $res = '';
        for($k=0; $k<strlen($s); $k++) {
            for($i=$k; $i<strlen($s); $i++) {
                $temp_str = '';
                for($j=$k; $j<=$i; $j++) {
                    $temp_str .= $s[$j];
                }
                if(strlen($temp_str)>strlen($res) && $this->isPalindrome($temp_str)) {
                    $res = $temp_str;
                }
            }
        }
        return $res;
    }

    # 检查字符串是否是回文字符串
    function isPalindrome($str) {

        while($str) {
            $l = 0;
            $r = strlen($str)-1;
            if($str[$l] != $str[$r]) {
                return false;
            }
            $str = substr($str,1,strlen($str)-2);
        }
        return true;
    }
}

# 中心拓展法
class Solution2 {

    /**
     * @param String $s
     * @return String
     */
    function longestPalindrome($s) {
        $str_len = strlen($s);
        if($str_len<=1) {
            return $s;
        }

        $start=0;$end=0;
        for($i=0; $i<$str_len; $i++) {
            $len1 = $this->expandAroundCenter($s, $i, $i);
            $len2 = $this->expandAroundCenter($s, $i, $i+1);
            $len = $len1>$len2 ? $len1 : $len2;
            if($len > $end-$start) {
                $start = $i - intval(($len-1)/2);
                $end = $i + intval($len/2);
            }
        }

        return substr($s, $start, $end-$start+1);
    }

    # 拓展从[$left,$right]的子串为中心的回文子串长度
    function expandAroundCenter($s, $left, $right) {
        $l = $left;
        $r = $right;
        while($l>=0 && $r<strlen($s) && $s[$l]==$s[$r]) {
            $l--;
            $r++;
        }
        return $r-$l-1;
    }
}

# 动态规划
class Solution3 {

    /**
     * @param String $s
     * @return String
     */
    function longestPalindrome($s) {
        # 一个字符必定是回文字符串
        $len = strlen($s);
        if($len<=1) {
            return $s;
        }

        # 保存最长回文字符的长度和字符串
        $longest = 1;
        $longest_str = $s[0];

        for($r=1; $r<$len; $r++) {
            for($l=0; $l<$r; $l++) {
                # $dp[$l][$r] 保存从$l到$r的字符串是否是回文字符串
                # $dp[$l][$r]是回文字符的条件为：字符$s[$r]与字符$s[$l]相等，且 $l+1到$r-1的字符也是回文字符（$l到$s去掉两边的字符的子字符串）
                # 这里需要特别注意的是，在新的边界字符$s[$r]与$s[$l]相等的情况下，$l与$r中间只间隔一个字符，或相邻，则$dp[$l][$r]必定为true；
                if($s[$r] == $s[$l] && ($r-$l<=2 || isset($dp[$l+1][$r-1]))) {
                    $dp[$l][$r]=true;
                    if($r-$l+1 > $longest) {
                        $longest = $r-$l+1;
                        $longest_str = substr($s, $l, $longest);
                    }
                }
            }
        }
        return $longest_str;
    }
}