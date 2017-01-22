<?php

/**
 * Implementation of binary tree.
 */
class Node {
    private $data;
    private $left;
    private $right;

    public function __construct($data, $left=NULL, $right=NULL) {
        $this->data = $data;
        $this->left = $left;
        $this->right = $right;
    }
}

class BinaryTree {
    private $root;

    public function __construct($data) {
        $this->root = new Node($data);
    }
}