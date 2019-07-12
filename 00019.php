<?php

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */

# PHP数组解法
/*
 * 遍历一遍链表，将「下标 =》节点」存储到数组中；
 * 计算要删除节点的下标，删除该节点（前一节点指向后一节点）；
 * 返回首节点；
 * */
class Solution {

    /**
     * @param ListNode $head
     * @param Integer $n
     * @return ListNode
     */
    function removeNthFromEnd($head, $n) {
        $arr = null;
        $curr = $head;
        while(!empty($curr)) {
            $arr[] = $curr;
            $curr = $curr->next;
        }
        $pos = count($arr) - $n;
        # 删除节点
        if($pos > 0) {
            $arr[$pos-1]->next = $arr[$pos+1]; # 将当前节点的前一个节点的next指向当前节点的后一个节点
            return $arr[0];
        } else {
            return isset($arr[1]) ? $arr[1] : [];
        }

    }
}

# 双节点解法
/*
 * 新建一个链表，头结点指向$head；
 * 新建两个节点$left、$right，指向原链表的头结点$head;
 * 先将节点$right移动n个位置，再同步移动这两个节点，直到$right指向null，确保节点$left、$right间隔为n个节点；
 * 删除$left后面的那个节点，即$left->next = $left->next->next;
 * 返回新链表的头节点的后一位（原$head的位置）
 *
 * */
class Solution2 {

    /**
     * @param ListNode $head
     * @param Integer $n
     * @return ListNode
     */
    function removeNthFromEnd($head, $n) {
        $list_node = new ListNode(0);
        $list_node->next = $head;
        $left = $list_node;
        $right = $list_node;
        for($i=0; $i<=$n; $i++) {
            $right = $right->next;
        }

        while(!empty($right)) {
            $right = $right->next;
            $left = $left->next;
        }
        $left->next = $left->next->next;
        return $list_node->next;
    }
}