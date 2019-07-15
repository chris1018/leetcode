<?php

# 从罗马字符的高位匹配递减
class Solution {

    /**
     * @param Integer $num
     * @return String
     */
    function intToRoman($num) {
        $char_list = [1000=>'M', 900=>'CM', 500=>'D', 400=>'CD', 100=>'C', 90=>'XC', 50=>'L', 40=>'XL', 10=>'X', 9=>'IX', 5=>'V', 4=>'IV', 1=>'I'];

        $res_str = '';
        foreach($char_list as $_num => $_char) {
            while($num >= $_num) {
                $res_str .= $_char;
                $num -=  $_num;
            }
            if($num == 0) {
                break;
            }
        }

        return $res_str;
    }
}

# 抽象计算每一位数字的罗马字符
class Solution2 {

    #罗马数字字符集
    protected $char_list = [
        [1=>'I', 4=>'IV', 5=>'V', 9=>'IX'], # 个位
        [1=>'X', 4=>'XL', 5=>'L', 9=>'XC'], # 十位
        [1=>'C', 4=>'CD', 5=>'D', 9=>'CM'], # 百位
        [1=>'M'] # 千位
    ];

    /**
     * @param Integer $num
     * @return String
     */
    function intToRoman($num) {
        $res_str = '';
        $i = 0;
        while($num>0) {
            $temp_num = $num%10;
            $temp_char = $this->caclDigitToRoman($i, $temp_num); # 计算当前位的数字的罗马字符；
            $res_str = $temp_char . $res_str; # 从低位计算，字符拼接到结果字符串的左边；
            $num = intval($num/10);
            $i++;
        }
        return $res_str;
    }

    # 计算每位数字对应的罗马字符
    /**
     * 算法逻辑：除千位，其他位数的值范围是1-9，组成分三种情况：n个1、n个1与5的组合、已定义数字；
     * @param Integer $pos
     * @param Integer $digit
     */
    function caclDigitToRoman($pos, $digit) {
        $res = '';
        $row = $this->char_list[$pos];
        if(isset($row[$digit])) {
            return $row[$digit];
        } elseif($digit>5) {
            $res = $row[5];
            $digit = $digit-5;
        }
        if($digit>0){
            for($i=0; $i<$digit; $i++) {
                $res .= $row[1];
            }
        }
        return $res;
    }
}

