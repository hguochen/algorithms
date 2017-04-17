<?php

// https://www.interviewbit.com/problems/diffk-ii/
// Given an array A of integers and another non negative integer k, find if
// there exists 2 indices i and j such that A[i] - A[j] = k, i != j.

// Example :

// Input :

// A : [1 5 3]
// k : 2
// Output :

// 1
// as 3 - 1 = 2

// Return 0 / 1 for this problem.

/**
 * Time: O(n)
 * Space: O(n)
 *
 */
function diffK($arr, $num) {
    if (empty($arr)) {
        return 0;
    }
    $table = [];

    for ($i=0; $i < sizeof($arr); $i++) { 
        if (isset($table[$arr[$i]])) {
            return 1;
        } else {
            $value1 = $arr[$i] - $num;
            $value2 = $arr[$i] + $num;
            $table[$value1] = 1;
            $table[$value2] = 1;
        }
    }

    return 0;
}

$arr1 = [1, 5, 3];
$arr2 = [ 77, 28, 19, 21, 67, 15, 53, 25, 82, 52, 8, 94, 50, 30, 37, 39, 9, 43, 35, 48, 82, 53, 16, 20, 13, 95, 18, 67, 77, 12, 93, 0 ];

echo diffK($arr1, 2) . PHP_EOL;
echo diffK($arr2, 53) . PHP_EOL;