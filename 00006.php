<?php
class Solution {

    /**
     * @param String $s
     * @param Integer $numRows
     * @return String
     */
    function convert($s, $numRows) {
        # 字符长度<=行数，则就是原字符串
        if(strlen($s)<=$numRows || $numRows<2) {
            return $s;
        }

        # 遍历字符串，按照Z的顺序将字符保存到二维数组中
        // 字符串的行数固定，利用行数和字符长度构建二维数组
        // 根据Z字形的特点，可知每$numRows-1列是Z的竖行，Z的斜线上的坐标刚好满足($row+$col)%($numRows-1)=0；
        $col = 0;
        while($s) {
            for($row=0; $row<$numRows; $row++) {
                if($s && ($col%($numRows-1)==0 || ($row+$col)%($numRows-1)==0)) {
                    $arr[$row][$col] = $s[0];
                    $s = substr($s,1);
                }
            }
            $col++;
        }

        # 遍历二维字符数组，拼接字符串
        $str = '';
        for($row=0; $row<$numRows; $row++) {
            foreach($arr[$row] as $value) {
                $str .= $value;
            }
        }
        return $str;

    }
}