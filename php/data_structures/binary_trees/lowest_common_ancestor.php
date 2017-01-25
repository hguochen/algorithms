<?php

/**
 * https://www.hackerrank.com/challenges/binary-search-tree-lowest-common-ancestor
 * You are given pointer to the root of the binary search tree and two values $value1
 * and $value2. You need to return the lowest common ancestor of both values in the
 * binary search tree.
 * Return the node representing the lowest common ancestor.
 */

function lowestCommonAncestor($root, $value1, $value2) {
    if (empty($root)) {
        return;
    } else if ($root->data == $value1 || $root->data == $value2) {
        return;
    }
    $value1Path = getValuePath($root, $value1);
    $value2Path = getValuePath($root, $value2);

    for ($i=sizeof($value1Path)-1; $i <= 0; $i--) {
        for ($j=sizeof($value2Path)-1; $j <= 0; $j--) {
            if ($value2Path[$j] == $value1Path[$i]) {
                return $value2Path[$j];
            }
        }
    }
    return;
}

function getValuePath(&$node, $value) {
    if (empty($node)) {
        return;
    }
    $valuePath = [];
    $curr = $node;
    while (!empty($curr)) {
        if ($curr->data == $value1) {
            break;
        } else {
            $value1Path[] = $curr;
        }
        if ($value1 < $curr->data) {
            $curr = $curr->left;
        } else {
            $curr = $curr->right;
        }
    }
    return $valuePath;
}

function getValuePathRecursive(&$node, $value, &$container) {
    if (empty($node) || $node->data == $value) {
        return $container;
    }
    $container[] = $node;
    if ($value < $node->data) {
        getValuePathRecursive($node->left, $value, $container);
    } else {
        getValuePathRecursive($node->right, $value, $container);
    }
}