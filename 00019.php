<?php

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