<?php

// Given a set of distinct integers, S, return all possible subsets.

//  Note:
// Elements in a subset must be in non-descending order.
// The solution set must not contain duplicate subsets.
// Also, the subsets should be sorted in ascending ( lexicographic ) order.
// The list is not necessarily sorted.
// Example :

// If S = [1,2,3], a solution is:

// [
//   [],
//   [1],
//   [1, 2],
//   [1, 2, 3],
//   [1, 3],
//   [2],
//   [2, 3],
//   [3],
// ]

function subsets($arr) {
    if (empty($arr)) {
        return [];
    }
    sort($arr);
    $size = pow(2, sizeof($arr));
    $result = [];
    for ($i=0; $i < $size; $i++) { 
        $temp = [];
        for ($j=0; $j < sizeof($arr); $j++) { 
            if ($i & (1 << $j)) {
                $temp[] = $arr[$j];
            }
        }
        $result[] = $temp;
    }
    sort($result);
    return $result;
}

/**
 * Time: O(2^n)
 * Space: O(2^n)
 *
 */
function subsetsV2($arr) {
    if (empty($arr)) {
        return [];
    }
    sort($arr);
    $result = [];
    $curr = [];
    subsetsRecur($arr, $result, $curr, 0);
    sort($result);
    return $result;
}

function subsetsRecur($arr, &$result, &$curr, $index) {
    if ($index == sizeof($arr)) {
        $result[] = $curr;
        return;
    }
    subsetsRecur($arr, $result, $curr, $index+1);
    $curr[] = $arr[$index];
    subsetsRecur($arr, $result, $curr, $index+1);
    array_pop($curr);    
}

$arr1 = [1,2,3];

print_r(subsets($arr1));
print_r(subsetsV2($arr1));