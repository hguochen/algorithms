<?php

/**
 * Implementing a binary search tree.
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

    public function getRoot() {
        return $this->root;
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

    private function insertNode($parentNode, $newNode) {
        if ($newNode->data < $parentNode->data) {
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

$bst = new BinarySearchTree(40);
$root = $bst->getRoot();
$bst->insert(13);
$bst->insert(57);
$bst->insert(7);
$bst->insert(37);
$bst->insert(49);
$bst->insert(67);
$bst->insert(34);
$bst->insert(39);
$bst->insert(63);
$bst->insert(28);
$bst->insert(38);
$bst->insert(60);
$bst->insert(65);
$bst->insert(30);
$bst->insert(29);
$bst->insert(32);
$bst->preorder($root, 'printData');
echo PHP_EOL;
$bst->inorder($root, 'printData');
echo PHP_EOL;
$bst->postorder($root, 'printData');
echo PHP_EOL;