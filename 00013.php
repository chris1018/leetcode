<?php


class Solution {

    /**
     * @param String $s
     * @return Integer
     */

    function romanToInt($s) {
        $char_arr = ['I'=>1, 'V'=>5, 'X'=>10, 'L'=>50, 'C'=>100, 'D'=>500, 'M'=>1000];

        # 遍历字符串
        $sum = 0;
        $stack = 0;
        for($i=0; $i<strlen($s); $i++) {
            $char = strtoupper($s[$i]);
            # 判断当前字符组合标志位是否符合特殊情况
            if($stack>0) {
                if(in_array(intval($char_arr[$char]/$stack), [5,10], true)) { # 特殊情况
                    $sum += ($char_arr[$char]-$stack);
                    $stack = 0;
                    continue;
                }
                # 非特殊情况，加上标志位
                $sum += $stack;
            }
            # 判断当前字符是否符合标志位
            if(in_array($char, ['I','X','C'], true)) { # 可能满足特殊情况的，先将字符的值存入标志位，待下一步确认；
                $stack = $char_arr[$char];
                continue;
            } else {
                $stack = 0; # 恢复标志位
            }

            $sum += $char_arr[$char]; # 正常求和
        }

        return $sum+$stack;
    }


    # 穷举法
    function romanToInt2($s) {
        $char_list = ['IV'=>'4','IX'=>9,'XL'=>40,'XC'=>90,'CD'=>400,'CM'=>900,
            'I'=>1,'V'=>5,'X'=>10,'L'=>50,'C'=>100,'D'=>500,'M'=>1000];
        $len = strlen($s);
        $sum = 0;
        for($i=0; $i<$len; $i++) {
            $temp_str = $s[$i] . $s[$i+1];
            if(($i+1)<$len && isset($char_list[$temp_str])) {
                $sum += $char_list[$temp_str];
                $i++; // 跳过下一个字符
                continue;
            }
            $sum += $char_list[$s[$i]];
        }

        return $sum;
    }

    # 思路一改良
    function romanToInt3($s) {
        $char_arr = ['I'=>1, 'V'=>5, 'X'=>10, 'L'=>50, 'C'=>100, 'D'=>500, 'M'=>1000];
        $sum = 0;
        $pre = 1000;
        for($i=0; $i<strlen($s); $i++) {
            $current = $char_arr[$s[$i]];
            if($current > $pre) {
                $sum += $current - 2*$pre;
            } else {
                $sum += $current;
            }
            $pre = $current;
        }

        return $sum;
    }
}