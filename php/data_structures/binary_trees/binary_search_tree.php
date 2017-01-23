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

    public function delete($data) {
        if (empty($this->root)) {
            return false;
        }
        $node = $this->findNode($data);
        $parent = $this->findParentNode($node);
        echo "parent node is: " . $parent->data . PHP_EOL;
        // case 1: 0 children
        if (empty($node->left) && empty($node->right)) {
            if ($node == $this->root) {
                $this->root = NULL;
                return $this->root;
            } else if ($parent->left == $node) {
                $parent->left = NULL;
            } else {
                $parent->right = NULL;
            }
            return true;
        } else if (empty($node->left) || empty($node->right)) { // case 2: 1 children
            if ($node == $this->root) {
                if (!empty($node->left)) {
                    $this->root = $node->left;
                    return $this->root;
                } else{
                    $this->root = $node->right;
                    return $this->root;
                }
            } else if ($parent->left == $node) {
                if (!empty($node->left)) {
                    $parent->left = $node->left;
                    return $this->root;
                } else {
                    $parent->left = $node->right;
                    return $this->root;
                }
            } else if ($parent->right == $node) {
                if (!empty($node->left)) {
                    $parent->right = $node->left;
                    return $this->root;
                } else {
                    $parent->right = $node->right;
                    return $this->root;
                }
            }
            return true;
        }
        // case 3: 2 children
    }

    private function findParentNode(&$node) {
        if (empty($node)) {
            return NULL;
        }
        $prev = NULL;
        $curr = $this->root;
        while ($curr != NULL) {
            if ($curr == $node) {
                return $prev;
            } 
            $prev = $curr;
            if ($node->data < $curr->data) {
                $curr = $curr->left;
            } else {
                $curr = $curr->right;
            }
        }
    }
    public function find($data) {
        if (empty($this->root)) {
            return false;
        }
        $found = false;
        $curr = $this->root;
        while ($curr != NULL) {
            if ($curr->data == $data) {
                $found = true;
                break;
            } else {
                if ($data < $curr->data) {
                    if ($curr->left != NULL) {
                        $curr = $curr->left;
                    } else {
                        $found = false;
                        break;
                    }
                } else {
                    if ($curr->right != NULL) {
                        $curr = $curr->right;
                    } else {
                        $found = false;
                        break;
                    }
                }
            }
        }
        return $found;
    }

    public function findNode($data) {
        return $this->_findNode($this->root, $data);
    }

    private function _findNode($node, $data) {
        if (empty($node)) {
            return NULL;
        }
        if ($node->data == $data) {
            return $node;
        } else if ($data < $node->data) {
            return $this->_findNode($node->left, $data);
        } else {
            return $this->_findNode($node->right, $data);
        }
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

$bst->preorder($root);
echo PHP_EOL;
$bst->inorder($root);
echo PHP_EOL;
$bst->postorder($root);
echo PHP_EOL;
$bst->find(29);
$bst->find(32);

$bst->delete(39);
$bst->preorder($root);
echo PHP_EOL;
$bst->inorder($root);
echo PHP_EOL;
$bst->postorder($root);
echo PHP_EOL;