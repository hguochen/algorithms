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

    public function delete($data) {
        // check for null root
        if (empty($this->root)) {
            return false;
        }
        // find the data, if data not found, exit
        list($parent, $cue, $deleteNode) = $this->findNodeAndParent($data);

        // case 0: 0 child
        // case 1: 1 child
        if (empty($deleteNode->left) || empty($deleteNode->right)) {
            $this->replace($parent, $cue, $deleteNode);
        } else {
            // case 2: 2 child
        }        
    }

    /**
     * Replace the given node with its only child or NULL if its leaf node.
     */
    private function replace(&$parent, $cue, &$deleteNode) {
        // set child node
        if (empty($deleteNode->left)) {
            $child = $deleteNode->right;
        } else {
            $child = $deleteNode->left;
        }

        // delete root node
        if ($deleteNode == $this->root) {
            $this->root = $child;
            return $this->root;
        }
        // handle the case for non-root nodes
        if ($cue == 'left') {
            $parent->left = $child;
        } else if ($cue == 'right') {
            $parent->right = $child;
        }
        return $this->root;
    }

    /**
     * Find and return the parent node, left/right flag and data node.
     */
    private function findNodeAndParent($data) {
        $parent = NULL;
        if ($this->root->data == $data) {
            return [$parent, '', $this->root];
        }
        $curr = $this->root;
        while (!empty($curr)) {
            if ($curr->data == $data) {
                if ($parent->left == $curr) {
                    return [$parent, 'left', $curr];
                } else {
                    return [$parent, 'right', $curr];
                }
            } 
            $parent = $curr;
            if ($data < $curr->data) {
                $curr = $curr->left;
            } else {
                $curr = $curr->right;
            }
        }
    }

    private function findNode($node, $data) {
        if (empty($node)) {
            return NULL;
        }
        if ($node->data == $data) {
            return $node;
        } else if ($data < $node->data) {
            return $this->findNode($node->left, $data);
        } else {
            return $this->findNode($node->right, $data);
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
$bst->delete(67);
$bst->preorder($root, 'printData');
echo PHP_EOL;
$bst->inorder($root, 'printData');
echo PHP_EOL;
$bst->postorder($root, 'printData');
echo PHP_EOL;