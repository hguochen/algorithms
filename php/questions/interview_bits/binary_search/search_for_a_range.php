<?php

// Given a sorted array of integers, find the starting and ending position of a given target value.
// Your algorithm’s runtime complexity must be in the order of O(log n).
// If the target is not found in the array, return [-1, -1].

// Example:
// Given [5, 7, 7, 8, 8, 10]
// and target value 8,
// return [3, 4].

/**
 * Brute force.
 * Walk through the array tracking the starting and ending index if found.
 * 
 * Time: O(n)
 * Space: O(1)
 */
function searchRangeBrute($arr, $num) {
    $result = [-1, -1];
    if (empty($arr)) {
        return $result;
    }
    for ($i=0; $i < sizeof($arr); $i++) { 
        if ($arr[$i] > $num) {
            break;
        }
        if ($arr[$i] == $num) {
            if ($result[0] == -1) {
                $result[0] = $i;
            }
            $result[1] = $i;
        }
    }
    return $result;
}

/**
 * OPTIMAL
 * Binary search.
 * Search for the left occurence index and right occurence index.
 * 
 * Time: O(logn)
 * Space:O(1)
 *
 */
function searchRange($arr, $num) {
    $result = [-1, -1];
    if (empty($arr)) {
        return $result;
    }
    $result[0] = searchLeftIndex($arr, $num, 0, sizeof($arr)-1);
    $result[1] = searchRightIndex($arr, $num, 0, sizeof($arr)-1);
    return $result;
}

function searchRightIndex($arr, $num, $low, $high) {
    if ($low > $high) {
        return -1;
    }
    $mid = floor(($low + $high) / 2);
    if ($arr[$mid] == $num && ($mid+1 >= sizeof($arr) || $arr[$mid+1] != $num)) {
        return $mid;
    }
    if ($num >= $arr[$mid]) {
        return searchRightIndex($arr, $num, $mid+1, $high);
    } else {
        return searchRightIndex($arr, $num, $low, $mid-1);
    }
}

function searchLeftIndex($arr, $num, $low, $high) {
    if ($low > $high) {
        return -1;
    }
    $mid = floor(($low + $high) / 2);
    if ($arr[$mid] == $num && ($mid-1 < 0 || $arr[$mid-1] != $num)) {
        return $mid;
    }
    if ($num <= $arr[$mid]) {
        return searchLeftIndex($arr, $num, $low, $mid-1);
    } else {
        return searchLeftIndex($arr, $num, $mid+1, $high);
    }
}

/**
 * Uses binary search to find the number.
 * Once found, ripple left and right of the number to find the number duplicate
 * boundary.
 *
 * Time: O(logn) in general. but worst case results in O(n), where entire array is
 * the num
 * Space: O(1)
 */
function searchRangeCollated($arr, $num) {
    $result = [-1, -1];
    if (empty($arr)) {
        return $result;
    }
    binarySearch($arr, $num, $result, 0, sizeof($arr)-1);
    return $result;
}

function binarySearch($arr, $num, &$result, $low, $high) {
    if ($low > $high) {
        return;
    }
    $mid = floor(($low + $high) / 2);
    if ($arr[$mid] == $num && ($mid-1 < 0 || $arr[$mid] != $num)) {
        $result[0] = $mid;
    }
    if ($arr[$mid] == $num && ($mid+1 >= sizeof($arr) || $arr[$mid+1] != $num)) {
        $result[1] = $mid;
    }
    if ($num < $arr[$mid]) {
        return binarySearch($arr, $num, $result, $low, $mid-1);
    } elseif ($num > $arr[$mid]) {
        return binarySearch($arr, $num, $result, $mid+1, $high);
    } else {
        $left = $mid;
        while ($arr[$left] == $num) {
            $result[0] = $left;
            $left--;
        }
        $right = $mid;
        while ($arr[$right] == $num) {
            $result[1] = $right;
            $right++;
        }
        return;
    }
}


$arr1 = [5, 7, 7, 8, 8, 10];
$arr2 = [1,2,5,9,11,11,15];
$arr3 = [3,3,3,3,3,3,3,3,3];
$arr4 = [ 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 7, 8, 8, 8, 8, 8, 8, 8, 8, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 9, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10 ];

print_r(searchRangeBrute($arr1, 10));
print_r(searchRangeBrute($arr2, 11));
print_r(searchRangeBrute($arr3, 3));

print_r(searchRange($arr1, 10));
print_r(searchRange($arr2, 11));
print_r(searchRange($arr3, 3));
print_r(searchRange($arr4, 10));

print_r(searchRangeCollated($arr1, 10));
print_r(searchRangeCollated($arr2, 11));
print_r(searchRangeCollated($arr3, 3));
print_r(searchRangeCollated($arr4, 10));