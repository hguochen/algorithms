<?php

/**
 * Insertion sort.
 * Given an array of unsorted integers, split the array into sorted and
 * unsorted portion. Then take 1 element from unsorted portion and compare
 * with each element in sorted portion until it finds its place and get inserted
 * into that position.
 *
 * Worst time complexity: O(n^2)
 * Worst space complexity: O(1)
 */

$input1 = [14, 33, 27, 10, 35, 19, 42, 44];
$input2 = [64, 25, 12, 22, 11];

function insertionSort_v1($input) {
    for ($i=1; $i < sizeof($input); $i++) {
        $j = $i;
        while ($j > 0 && $input[$j-1] > $input[$j]) {
            $temp = $input[$j-1];
            $input[$j-1] = $input[$j];
            $input[$j] = $temp;
            $j--;
        }
    }
    return $input;
}

print_r(insertionSort_v1($input1));
print_r(insertionSort_v1($input2));