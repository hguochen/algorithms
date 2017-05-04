<?php

// Given a collection of numbers, return all possible permutations.

// Example:

// [1,2,3] will have the following permutations:

// [1,2,3]
// [1,3,2]
// [2,1,3] 
// [2,3,1] 
// [3,1,2] 
// [3,2,1]

/**
 * Time: O(n!)
 * Space: O(n!)
 */
function permutations($arr) {
    if (empty($arr)) {
        return $arr;
    }
    $result = [];
    computePermutations($arr, $result, 0);
    return $result;
}

function computePermutations($arr, &$result, $index) {
    if ($index == sizeof($arr)) {
        return;
    }
    for ($i=$index; $i < sizeof($arr); $i++) { 
        swap($arr[$index], $arr[$i]);
        if (empty($result) || !in_array($arr, $result)) {
            $result[] = $arr;
        }
        computePermutations($arr, $result, $index+1);
        swap($arr[$index], $arr[$i]);
    }
}

function swap(&$v1, &$v2) {
    $temp = $v1;
    $v1 = $v2;
    $v2 = $temp;
}

$arr1 = [1,2,3,4];
$arr2 = [];

print_r(permutations($arr1));