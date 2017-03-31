<?php

// Write an efficient algorithm that searches for a value in an m x n matrix.

// This matrix has the following properties:

// Integers in each row are sorted from left to right.
// The first integer of each row is greater than or equal to the last integer of the previous row.
// Example:

// Consider the following matrix:

// [
//   [1,   3,  5,  7],
//   [10, 11, 16, 20],
//   [23, 30, 34, 50]
// ]
// Given target = 3, return 1 ( 1 corresponds to true )

// Return 0 / 1 ( 0 if the element is not present, 1 if the element is present ) for this problem

/**
 * OPTIMAL
 * Binary search
 * 1. find the row index at which the element could possibly be in. O(n)
 * 2. once found the row, use binary search to search if the num is in matrix.
 *
 * Time: O(nlogm) where n is size of row, m is size of column
 * Space: O(1)
 * 
 */
function hasNumber($matrix, $num) {
    if (empty($matrix)) {
        return 0;
    }
    // find index row at which the number could possibly be
    $index = findIndex($matrix, $num);
    if ($index == -1) {
        return 0;
    }
    // for the current row, use binary search to find the number
    return binarySearch($matrix[$index], $num, 0, sizeof($matrix[0])-1);
}

function findIndex($matrix, $num) {
    $index = -1;
    if ($matrix[0][0] > $num) {
        return $index;
    }
    for ($i=0; $i < sizeof($matrix); $i++) { 
        if ($matrix[$i][0] > $num) {
            $index = $i - 1;
            break;
        }
    }
    if ($index == -1) {
        return sizeof($matrix) - 1;
    }
    return $index;
}

function binarySearch($arr, $num, $low, $high) {
    if ($low > $high) {
        return 0;
    }
    $mid = floor(($low + $high) / 2);
    if ($arr[$mid] == $num) {
        return 1;
    }
    if ($num < $arr[$mid]) {
        return binarySearch($arr, $num, $low, $mid-1);
    }
    return binarySearch($arr, $num, $mid+1, $high);
}

$matrix1 = [
  [1,   3,  5,  7],
  [10, 11, 16, 20],
  [23, 30, 34, 50]
];
$matrix2 = [
    [1]
];

// echo hasNumber($matrix1, 3);
echo hasNumber($matrix2, 1);