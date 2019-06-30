<?php

/*
 * 算法解析
 * - 将两个链表的每个节点数值相加，对于长度不够的链表，值用0代替；
 * - 节点的和=链表1第n个节点的值+链表2第n个节点的值+进位值；
 * - 记得移动节点；
 * */
/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution {

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2) {
        $p = $l1;
        $q = $l2;
        $head = null; # 链表的首节点
        $curr = null; # 链表的当前节点
        $carry = 0; # 进位
        while(!empty($p) || !empty($q)) {
            $num1 = empty($p) ? 0 : $p->val;
            $num2 = empty($q) ? 0 : $q->val;
            $sum = $num1 + $num2 + $carry; # 计算该列数字的和
            $carry = intval($sum/10); # 计算新的进位，在下一列计算时用
            if(empty($head)) {
                $head = new ListNode($sum%10);
                $curr = $head;
            } else {
                $curr = new ListNode($sum%10);
            }
            # 当前节点后移
            $curr = &$curr->next;
            $p = &$p->next;
            $q = &$q->next;
        }

        if($carry > 0) {
            $curr = new ListNode($carry);
        }

        return $head;
    }
}