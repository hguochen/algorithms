<?php

// Given a collection of integers that might contain duplicates, S, return all possible subsets.

//  Note:
// Elements in a subset must be in non-descending order.
// The solution set must not contain duplicate subsets.
// The subsets must be sorted lexicographically.
// Example :
// If S = [1,2,2], the solution is:

// [
// [],
// [1],
// [1,2],
// [1,2,2],
// [2],
// [2, 2]
// ]

function subsets($arr) {
    if (empty($arr)) {
        return [$arr];
    }
    sort($arr);
    $result = [[]];
    $temp = [];
    generateSubsets($arr, $result, $temp, 0);
    return $result;
}

function generateSubsets($arr, &$result, &$temp, $index) {
    if ($index == sizeof($arr)) {
        $temp = [];
        return;
    }

    for ($i=$index; $i < sizeof($arr); $i++) { 
        $temp[] = $arr[$i];
        $tempStr = implode("", $temp);
        if (!isset($result[$tempStr])) {
            $result[$tempStr] = $temp;
        }
        generateSubsets($arr, $result, $temp, $i+1);
    }
}

function subsetsV2($arr) {
    if (empty($arr)) {
        return [$arr];
    }
    sort($arr);
    $result = [];
    $temp = [];
    generateSubsetsV2($arr, $result, $temp, 0);
    return $result;
}

function generateSubsetsV2($arr, &$result, &$temp, $index) {
    if ($index == sizeof($arr)) {
        $result[] = $temp;
        return;
    }
    # not adding this element
    $i = $index;
    while ($i < sizeof($arr) && $arr[$i] == $arr[$index]) {
        $i++;
    }
    generateSubsetsV2($arr, $result, $temp, $i);

    #adding this element
    $temp[] = $arr[$index];
    generateSubsetsV2($arr, $result, $temp, $index+1);
    array_pop($temp);
}

$arr1 = [1,2,2];
$arr2 = [ 5, 4 ];

print_r(subsets($arr1));
print_r(subsets($arr2));

print_r(subsetsV2($arr2));
print_r(subsetsV2($arr2));