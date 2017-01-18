<?php

/**
 * Merge sort.
 * Typical divide and conquer approach.
 * Recursively divide the array to half the size until there is only 1 element
 * left in each subarray. Then merge the subarrays in ascending/descending order
 * until the original array is merged back in ascending/descending order.
 *
 * Worst time complexity: O(nlgn)
 * Worst space complexity: O(n)
 */

$input1 = [14, 33, 27, 10, 35, 19, 42, 44];
$input2 = [64, 25, 12, 22, 11];

function mergesort($input) {
    if (sizeof($input) <= 1) {
        return $input;
    }

    $mid = (int) (sizeof($input) / 2);
    $left = array_slice($input, 0, $mid);
    $right = array_slice($input, $mid);
    $left = mergesort($left);
    $right = mergesort($right);
    return merge($left, $right);
}
function merge($left, $right) {
    $result = [];

    while (!empty($left) && !empty($right)) {
        if ($left[0] < $right[0]) {
            $result[] = array_shift($left);
        } else {
            $result[] = array_shift($right);
        }
    }
    if (!empty($left)) {
        $result = array_merge($result, $left);
    }
    if (!empty($right)) {
        $result = array_merge($result, $right);
    }
    return $result;
}

print_r(mergesort($input1));