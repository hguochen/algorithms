<?php

// A linked list is given such that each node contains an additional random
// pointer which could point to any node in the list or NULL.

// Return a deep copy of the list.

// Example

// Given list

//    1 -> 2 -> 3
// with random pointers going from

//   1 -> 3
//   2 -> 1
//   3 -> 1
// You should return a deep copy of the list. The returned answer should not
// contain the same node as the original list, but a copy of them. The pointers
// in the returned list should not link to any node in the original input list.

/**
 * 1. Loop through the list.
 * 2. for each node, create a new node with the same data.
 * 3. point next pointer of prev node to new node.
 * 4. store in a hashtable with key as node's data, value as the new node
 * 5. loop through the new node, for each node data, find the random node in the
 * value and point to that node.
 * 
 * Time: O(n) where n is the size of the linked list.
 * Space: O(n) deep copy of linked list
 */
function copyList($head) {
    if (empty($head)) {
        return;
    }
    $newHead = new RNode(0);
    $prevNew = $newHead;

    $curr = $head;
    $table = [];
    while (!empty($curr)) {
        $newNode = new RNode($curr->data);
        $prevNew->next = $newNode;
        if (!isset($table[$curr->data])) {
            $table[$curr->data] = $newNode;
        }

        $prevNew = $newNode;
        $curr = $curr->next;
    }

    $newHead = $newHead->next;
    $currNew = $newHead;
    $curr = $head;
    while (!empty($curr)) {
        $rNodeData = $curr->random->data;
        $rNode = $table[$rNodeData];
        $currNew->random = $rNode;
        $currNew = $currNew->next;
        $curr = $curr->next;
    }
    return $newHead;
}

$node1 = new RNode(1);
$node2 = new RNode(2);
$node3 = new RNode(3);
$node1->next = $node2;
$node2->next = $node3;
$node1->random = $node3;
$node2->random = $node1;
$node3->random = $node1;

$result = copyList($node1);
while (!empty($result)) {
    echo $result->data . ": " . $result->next->data . " " . $result->random->data . PHP_EOL;
    $result = $result->next;
}

class RNode {
    public $data;
    public $next;
    public $random;

    public function __construct($data, $next=NULL, $random=NULL) {
        $this->data = $data;
        $this->next = $next;
        $this->random = $random;
    }
}