<?php

/**
 * Quick sort.
 * Divide and conquer approach.
 * Divide by choosing the last element as pivot element. Then Conquer by going
 * through the unsorted portion and split them between elements less than or
 * equal(on the left) to pivot or more than pivot(on the right). Once split is
 * done, move the pivot to in between the two sides.
 * Do above steps recursively.
 *
 * Although quick sort has worst case complexity equal to that of insertion sort,
 * selection sort. but amortized running complexity is actually much faster than
 * sometimes even mergesort.
 *
 * Worst time complexity: O(n^2)
 * Best time complexity: O(nlgn)
 * Worst space complexity: O(1)
 */

$input1 = [14, 33, 27, 10, 35, 19, 42, 44];
$input2 = [64, 25, 12, 22, 11];

function quicksort($input) {
    $start = 0;
    $end = sizeof($input) - 1;

    return _quicksort($input, $start, $end);
}

function _quicksort(&$input, $start, $end) {
    if ($end-$start > 0) {
        $pivot = partition($input, $start, $end);
        _quicksort($input, $start, $pivot-1);
        _quicksort($input, $pivot+1, $end);
    }
    return $input;
}

function partition(&$input, $start, $end) {
    $resultIndex = $start;
    $nextIndex = $start;
    // echo $nextIndex.PHP_EOL;
    // echo $end.PHP_EOL;

    while ($nextIndex < $end) {
        if ($input[$nextIndex] > $input[$end]) {
            $nextIndex++;
        } else {
            $temp = $input[$resultIndex];
            $input[$resultIndex] = $input[$nextIndex];
            $input[$nextIndex] = $temp;
            $resultIndex++;
            $nextIndex++;
        }
    }    
    $temp = $input[$end];
    $input[$end] = $input[$resultIndex];
    $input[$resultIndex] = $temp;
    return $resultIndex;
}

// echo partition($input1, 0, sizeof($input1)-3) . PHP_EOL;
print_r(quicksort($input1));