<?php

// Reverse a linked list using recursion.

// Example :
// Given 1->2->3->4->5->NULL,

// return 5->4->3->2->1->NULL.

/**
 * OPTIMAL.
 * Time: O(n)
 * Space: O(1)
 */
function reverse($prev, $curr, $next) {
    if (empty($curr)) {
        return NULL;
    }
    $next = $curr->next;
    $curr->next = $prev;
    return reverse($curr, $next, $next);
}

reverse(NULL, $head, $NULL);