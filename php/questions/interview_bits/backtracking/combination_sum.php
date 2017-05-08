<?php

// Given a set of candidate numbers (C) and a target number (T), find all unique combinations in C where the candidate numbers sums to T.

// The same repeated number may be chosen from C unlimited number of times.

//  Note:
// All numbers (including target) will be positive integers.
// Elements in a combination (a1, a2, … , ak) must be in non-descending order. (ie, a1 ≤ a2 ≤ … ≤ ak).
// The combinations themselves must be sorted in ascending order.
// CombinationA > CombinationB iff (a1 > b1) OR (a1 = b1 AND a2 > b2) OR … (a1 = b1 AND a2 = b2 AND … ai = bi AND ai+1 > bi+1)
// The solution set must not contain duplicate combinations.
// Example, 
// Given candidate set 2,3,6,7 and target 7,
// A solution set is:

// [2, 2, 3]
// [7]

function combinationSum($arr, $target) {
    if (empty($arr)) {
        return [[]];
    }
    sort($arr);
    list($result, $curr) = [[],[]];
    combinationSumRecur($arr, $target, $result, $curr, 0);
    return array_values($result);
}

function combinationSumRecur($arr, $target, &$result, &$curr, $index) {
    if ($target == 0) {
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
        combinationSumRecur($arr, $target - $arr[$i], $result, $curr, $i);
        array_pop($curr);
    }
}

$arr1 = [2,3,7, 6];
$arr2 = [2,3,3,7, 6];
$arr3 = [ 8, 10, 6, 11, 1, 16, 8 ];
print_r(combinationSum($arr1, 7));
print_r(combinationSum($arr2, 7));
print_r(combinationSum($arr3, 28));