<?php

// There are two sorted arrays A and B of size m and n respectively.
// Find the median of the two sorted arrays ( The median of the array formed by merging both the arrays ).
// The overall run time complexity should be O(log (m+n)).

// Sample Input
// A : [1 4 5]
// B : [2 3]

// Sample Output
// 3

/**
 * Brute Force.
 * Merge the 2 sorted arrays.
 * Find the median in the merged array.
 * Time: O(m+n)
 */
function medianOfArrayBrute($arr1, $arr2) {
    if (empty($arr1)) {
        return getMedian($arr2);
    } elseif (empty($arr2)) {
        return getMedian($arr1);
    }
    // merge the arrays
    $merged = merge($arr1, $arr2);
    return getMedian($merged);
}

function getMedian($arr) {
    if (empty($arr)) {
        return -1;
    }
    $mid = floor((0 + sizeof($arr)-1) / 2);
    if (sizeof($arr) % 2 == 0) {
        return ($arr[$mid] + $arr[$mid+1]) / 2;
    } else {
        return $arr[$mid];
    }
}

/**
 * OPTIMAL
 * INCORRECT.
 * Binary search.
 * 1. get mid of arr1 and arr2
 * 2. construct new array with left and right as the 2 median in sorted order
 * 3. return median of the new array
 *
 * Time: O(log(m+n))
 * space: O(m+n)
 */
function medianOfArray($arr1, $arr2) {
    if (empty($arr1)) {
        return getMedian($arr2);
    } elseif (empty($arr2)) {
        return getMedian($arr1);
    }
    $mid1 = floor((0 + sizeof($arr1)-1) / 2);
    $mid2 = floor((0 + sizeof($arr2)-1) / 2);

    $merged = [];
    if ($arr1[$mid1] < $arr2[$mid2]) {
        list($lowLimit, $highLimit) = [$arr1[$mid1], $arr2[$mid2]];
    } elseif ($arr1[$mid1] > $arr2[$mid2]) {
        list($lowLimit, $highLimit) = [$arr2[$mid2], $arr1[$mid1]];
    }
    $temp1 = getArrayLimits($arr1, $lowLimit, $highLimit);
    $temp2 = getArrayLimits($arr2, $lowLimit, $highLimit);
    $merged = merge($temp1, $temp2);
    return getMedian($merged);
}

function getArrayLimits($arr, $low, $high) {
    $result = [];
    for ($i=0; $i < sizeof($arr); $i++) { 
        if ($arr[$i] >= $low && $arr[$i] <= $high) {
            $result[] = $arr[$i];
        }
    }
    return $result;
}

function merge($arr1, $arr2) {
    $result = [];
    while (!empty($arr1) && !empty($arr2)) {
        if ($arr1[0] < $arr2[0]) {
            $result[] = array_shift($arr1);
        } else {
            $result[] = array_shift($arr2);
        }
    }
    while (!empty($arr1)) {
        $result[] = array_shift($arr1);
    }
    while (!empty($arr2)) {
        $result[] = array_shift($arr2);
    }
    return $result;
}

$arr1 = [1,4,5];
$arr2 = [2,3];

$arr3 = [1,12,15,26,38];
$arr4 = [2,13,17,30,45];

$arr5 = [ -50, -41, -40, -19, 5, 21, 28 ];
$arr6 = [ -50, -21, -10 ];

$arr7 = [0, 23];
$arr8 = [];

$arr9 = [ -40, -25, 5, 10, 14, 28, 29, 48 ];
$arr10 = [ -48, -31, -15, -6, 1, 8 ];

$arr11 = [ -50, -47, -36, -35, 0, 13, 14, 16 ];
$arr12 = [ -31, 1, 9, 23, 30, 39 ];
// echo medianOfArray($arr1, $arr2) . PHP_EOL;
// echo medianOfArray($arr3, $arr4) . PHP_EOL;
// echo medianOfArray($arr5, $arr6) . PHP_EOL;
// echo medianOfArray($arr7, $arr8) . PHP_EOL;
// echo medianOfArray($arr9, $arr10) . PHP_EOL;
// echo medianOfArray($arr11, $arr12) . PHP_EOL;

echo medianOfArrayBrute($arr1, $arr2) . PHP_EOL;
// echo medianOfArrayBrute($arr3, $arr4) . PHP_EOL;
// echo medianOfArrayBrute($arr5, $arr6) . PHP_EOL;
// echo medianOfArrayBrute($arr7, $arr8) . PHP_EOL;
// echo medianOfArrayBrute($arr9, $arr10) . PHP_EOL;
// echo medianOfArrayBrute($arr11, $arr12) . PHP_EOL;
