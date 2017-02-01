<?php

class Node {
    public $data;
    public $isRed;
    public $left;
    public $right;

    public function __construct($data, $isRed=true, $left=NULL, $right=NULL) {
        $this->data = $data;
        $this->isRed = $isRed;
        $this->left = $left;
        $this->right = $right;
    }
}

class RedBlackTree {
    private $root;

    public function __construct($data, $isRed=false, $left=NULL, $right=NULL) {
        $this->root = new Node($data, $isRed, $left, $right);
    }

    private function leftRotate($node) {
        // set y reference to node's right child
        $rightNode = $node->right;
        // set node's right child to y's left child
        $node->right = $rightNode->left;
        // get node's parent, if parent is null. its root case. root pointer is now pointed to y
        $parent = $this->getParentNode($node);
        if (empty($parent)) {
            $this->root = $rightNode;
        } elseif ($parent->left == $node) { // set node's parent to y's parent now. determine parent.left or parent.right
            $parent->left = $rightNode;
        } else {
            $parent->right = $rightNode;
        }
        // set y be parent of node
        $rightNode->left = $node;
    }

    private function rightRotate($node) {
        // set y as node.left reference
        // set node.left to y.right
        // find parent node
        // handle root node case
        // set parent to point to new leftNode
        // leftnode.right = node
        $leftNode = $node->left;
        $node->left = $leftNode->right;

        $parent = $this->getParentNode($node);
        if (empty($parent)) {
            $this->root = $leftNode;
        } elseif ($parent->left == $node) {
            $parent->left = $leftNode;
        } else {
            $parent->right = $leftNode;
        }
        $leftNode->right = $node;
    }

    private function getParentNode($node) {
        if (empty($this->root) && empty($node)) {
            return NULL;
        }
        $parent = NULL;
        $curr = $this->root;
        while (!empty($curr)) {
            if ($node->data == $curr->data) {
                return $parent;
            }
            $parent = $curr;
            if ($node->data < $curr->data) {
                $curr = $curr->left;
            } else {
                $curr = $curr->right;
            }
        }
    }

    public function printData($node) {
        echo "{$node->data} ";
    }

    public function preorder($node, $callback) {
        if (empty($node)) {
            return;
        }
        $this->$callback($node);
        $this->preorder($node->left, $callback);
        $this->preorder($node->right, $callback);
    }

    public function inorder($node, $callback) {
        if (empty($node)) {
            return;
        }
        $this->inorder($node->left, $callback);
        $this->$callback($node);
        $this->inorder($node->right, $callback);
    }

    public function postorder($node, $callback) {
        if (empty($node)) {
            return;
        }
        $this->postorder($node->left, $callback);
        $this->postorder($node->right, $callback);
        $this->$callback($node);
    }
}