<?php

/**
 * Selection sort.
 * Given an array of unsorted integers, splitting the array into sorted and
 * unsorted portion, repeatedly find the smallest remaining unsorted element
 * and puts it at the end of the sorted portion of the array.
 *
 * Worst time complexity: O(n^2)
 * Worst space complexity: O(1)
 */

$input1 = [14, 33, 27, 10, 35, 19, 42, 44];
$input2 = [64, 25, 12, 22, 11];

function selectionSort_v1($input) {
    $result = $input;
    // set last sorted index, initialized to 0. this splits sorted and unsorted portion
    $firstUnsortedIndex = 0;
    // inside the unsorted portion, find the smallest value, and note it's index.
    // swap the index small value with the next value of last sorted index
    // increment index.
    for ($i=$firstUnsortedIndex; $i < sizeof($result); $i++) {
        $smallestIndex = $i;
        for ($j=$i+1; $j < sizeof($result); $j++) {
            if ($result[$j] < $result[$smallestIndex]) {
                $smallestIndex = $j;
            }
        }
        // swap smallest remaining element with first unsorted element
        $temp = $result[$firstUnsortedIndex];
        $result[$firstUnsortedIndex] = $result[$smallestIndex];
        $result[$smallestIndex] = $temp;
        $firstUnsortedIndex++;
    }
    return $result;
}

function selectionSort_v2($input) {    
    for ($i=0; $i < sizeof($input); $i++) {
        $minIndex = $i;
        for ($j=$i+1; $j < sizeof($input); $j++) {
            if ($input[$j] < $input[$minIndex]) {
                $minIndex = $j;
            }
        }
        $temp = $input[$i];
        $input[$i] = $input[$minIndex];
        $input[$minIndex] = $temp;
    }
    return $input;
}

print_r(selectionSort_v1($input1));
print_r(selectionSort_v1($input2));
print_r(selectionSort_v2($input1));
print_r(selectionSort_v2($input2));