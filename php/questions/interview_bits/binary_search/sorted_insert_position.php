<?php

// Given a sorted array and a target value, return the index if the target is
// found. If not, return the index where it would be if it were inserted in order.

// You may assume no duplicates in the array.

// Here are few examples.

// [1,3,5,6], 5 → 2
// [1,3,5,6], 2 → 1
// [1,3,5,6], 7 → 4
// [1,3,5,6], 0 → 0

/**
 * OPTIMAL
 * Binary Search.
 *
 * Typical binary search with additional return condition for when the mid value
 * is more than number and mid-1 value is less than number.
 * Time: O(logn)
 * Space: O(1)
 * 
 */
function insertPosition($arr, $num) {
    if (empty($arr)) {
        return 0;
    }
    return binarySearch($arr, $num, 0, sizeof($arr)-1);
}

function binarySearch($arr, $num, $low, $high) {
    if ($low > $high) {
        return;
    }
    $mid = floor(($low + $high) / 2);
    if ($arr[$mid] == $num) {
        return $mid;
    } elseif ($num < $arr[$mid] && $mid-1 < 0) {
        return $mid;
    } elseif ($num > $arr[$mid] && $mid + 1 >= sizeof($arr)) {
        return $mid+1;
    } elseif ($num < $arr[$mid] && $num > $arr[$mid-1]) {
        return $mid;
    }
    if ($num < $arr[$mid]) {
        return binarySearch($arr, $num, $low, $mid-1);
    }
    return binarySearch($arr, $num, $mid+1, $high);
}

$arr1 = [1,3,5,6]; //5 → 2
 //2 → 1
 //7 → 4
 //0 → 0

echo insertPosition($arr1, 5) . PHP_EOL;
echo insertPosition($arr1, 2) . PHP_EOL;
echo insertPosition($arr1, 7) . PHP_EOL;
echo insertPosition($arr1, 0) . PHP_EOL;