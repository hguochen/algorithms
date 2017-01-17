<?php

/**
 * Bubble sort
 * Given an unsorted array of integers, repeatedly swap adjacent pairs until
 * the array is in sorted order.
 *
 * Worst time complexity: O(n^2)
 * Worst space complexity: O(1)
 */

$input1 = [14, 33, 27, 10, 35, 19, 42, 44];
$input2 = [64, 25, 12, 22, 11];

function bubbleSort($input) {
    do {
        $swapped = false;
        for ($i=0; $i < sizeof($input)-1; $i++) { // O(n)
            if ($input[$i] > $input[$i+1]) {
                $temp = $input[$i];
                $input[$i] = $input[$i+1];
                $input[$i+1] = $temp;
                $swapped = true;
            }
        }
    } while ($swapped);
    return $input;
}

print_r(bubbleSort($input1));
print_r(bubbleSort($input2));