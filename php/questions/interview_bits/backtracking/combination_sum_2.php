<?php

// Given a collection of candidate numbers (C) and a target number (T), find all unique combinations in C where the candidate numbers sums to T.

// Each number in C may only be used once in the combination.

//  Note:
// All numbers (including target) will be positive integers.
// Elements in a combination (a1, a2, … , ak) must be in non-descending order. (ie, a1 ≤ a2 ≤ … ≤ ak).
// The solution set must not contain duplicate combinations.
// Example :

// Given candidate set 10,1,2,7,6,1,5 and target 8,

// A solution set is:

// [1, 7]
// [1, 2, 5]
// [2, 6]
// [1, 1, 6]

function combineSum($arr, $target) {
    if (empty($arr)) {
        return [[]];
    }
    sort($arr);
    list($result, $curr) = [[],[]];
    combineSumRecur($arr, $target, $result, $curr, 0);
    return array_values($result);
}

function combineSumRecur($arr, $target, &$result, &$curr, $index) {
    if ($target == 0) {
        sort($curr);
        $key = implode("", $curr);
        if (!isset($result[$key])) {
            $result[$key] = $curr;
        }
        return;
    }
    for ($i=$index; $i < sizeof($arr); $i++) { 
        if ($arr[$i] > $target) {
            return;
        }
        $curr[] = $arr[$i];
        combineSumRecur($arr, $target-$arr[$i], $result, $curr, $i+1);
        array_pop($curr);
    }
}

$arr1 = [10,1,2,7,6,1,5];

print_r(combineSum($arr1, 8));
