<?php

/**
 * Implementation of a binary search tree.
 */
class Node {
    public $data;
    public $left;
    public $right;

    public function __construct($data, $left=NULL, $right=NULL) {
        $this->data = $data;
        $this->left = $left;
        $this->right = $right;
    }
}

class BinarySearchTree {
    private $root;

    public function __construct($data) {
        $this->root = new Node($data);
    }

    public function insert($data) {
        $newNode = new Node($data);
        if (empty($this->root)) {
            $this->root = $newNode;
            return $this->root;
        }
        $this->insertNode($this->root, $newNode);
        return $this->root;
    }

    public function getRoot() {
        return $this->root;
    }

    public function preorder($node) {
        if (empty($node)) {
            return;
        }
        echo $node->data . " ";
        $this->preorder($node->left);
        $this->preorder($node->right);
    }

    public function inorder($node) {
        if (empty($node)) {
            return;
        }
        $this->inorder($node->left);
        echo $node->data . " ";
        $this->inorder($node->right);
    }

    public function postorder($node) {
        if (empty($node)) {
            return;
        }
        $this->postorder($node->left);
        $this->postorder($node->right);
        echo $node->data . " ";
    }

    protected function insertNode($parentNode, $newNode) {
        if ($newNode->data <= $parentNode->data) {
            if (empty($parentNode->left)) {
                $parentNode->left = $newNode;
            } else {
                $this->insertNode($parentNode->left, $newNode);
            }
        } else {
            if (empty($parentNode->right)) {
                $parentNode->right = $newNode;
            } else {
                $this->insertNode($parentNode->right, $newNode);
            }
        }
    }
}

$bst = new BinarySearchTree(7);
$root = $bst->getRoot();
$bst->insert(1);
$bst->insert(9);
$bst->insert(0);
$bst->insert(3);
$bst->insert(8);
$bst->insert(10);
$bst->insert(2);
$bst->insert(5);
$bst->insert(4);
$bst->insert(6);
$bst->preorder($root);
echo PHP_EOL;
$bst->inorder($root);
echo PHP_EOL;
$bst->postorder($root);
echo PHP_EOL;