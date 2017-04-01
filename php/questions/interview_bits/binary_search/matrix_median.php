<?php

// Given a N cross M matrix in which each row is sorted, find the overall median
// of the matrix. Assume N*M is odd.

// For example,

// Matrix=
// [1, 3, 5]
// [2, 6, 9]
// [3, 6, 9]

// A = [1, 2, 3, 3, 5, 6, 6, 9, 9]

// Median is 5. So, we return 5.
// 
// Answer: https://kartikkukreja.wordpress.com/2016/10/11/problem-of-the-day-matrix-median/

/**
 * Brute force.
 * 1. merge all the rows together into 1 sorted array. 
 * 2. find the median value in the sorted array.
 *
 * Time: O(n^2*m)
 * Space: O(n*m)
 */
function findMedianBrute($matrix) {
    if (empty($matrix)) {
        return;
    }
    $merged = [];
    for ($i=0; $i < sizeof($matrix); $i++) { 
        $merged = merge($merged, $matrix[$i]);
    }

    $mid = floor((0 + sizeof($merged)-1) / 2);
    if (sizeof($merged) % 2 == 0) {
        return ($merged[$mid] + $merged[$mid + 1]) / 2;
    }
    return $merged[$mid];
}

/**
 * Merge
 * Time: O(n*m) where n is size of arr1, m size of arr2
 * 
 */
function merge($arr1, $arr2) {
    $result = [];
    $left = 0;
    $right = 0;
    while ($left < sizeof($arr1) && $right < sizeof($arr2)) {
        if ($arr1[$left] < $arr2[$right]) {
            $result[] = $arr1[$left];
            $left++;
        } else {
            $result[] = $arr2[$right];
            $right++;
        }
    }
    while ($left < sizeof($arr1)) {
        $result[] = $arr1[$left];
        $left++;
    }
    while ($right < sizeof($arr2)) {
        $result[] = $arr2[$right];
        $right++;
    }
    return $result;
}

/**
 * OPTIMAL.
 * Binary search.
 * NOTE: only works for finding median in odd total number of elements in matrix.
 * 
 * 1. get min and max values in the matrix
 * 2. use min and max to calulate the mid value of the values
 * 3. repeatedly test if the mid value can be the median.
 * 4. a mid value can be a possible median candidate if there are equal number of
 * values less than or more than the mid value.
 * 5. if values less than mid are less than the equal portion number, we do binary search
 * on the right side.
 * 6. if values less than mid are equal to or more than the equal portion number, we do 
 * binary search on the left side.
 *
 * Time: O((n*m) * log(n*m))
 * Space: O(1)
 */
function findMedian($matrix) {
    if (empty($matrix)) {
        return;
    }
    
    // find min and max value in matrix
    list($min, $max) = getMinMaxValues($matrix);

    // init result and get num of values less than median
    $result = PHP_INT_MAX;
    $matrixSize = sizeof($matrix) * sizeof($matrix[0]);
    $lessCount = floor(($matrixSize / 2) + 1);

    // test all mid values for possibility
    while ($min <= $max) {
        $mid = floor(($min + $max) / 2);
        list($count, $isPossible) = elementsLessThan($matrix, $mid);

        if ($count >= $lessCount) {
            $result = min($result, $mid);
            $max = $mid - 1;
        } else {
            $min = $mid + 1;
        }
    }
    return $result;
}

/**
 * Get min and max values of the marix.
 * Time: O(n)
 */
function getMinMaxValues($matrix) {
    list($min, $max) = [PHP_INT_MAX, -10000000000];
    for ($i=0; $i < sizeof($matrix); $i++) { 
        if ($matrix[$i][0] < $min) {
            $min = $matrix[$i][0];
        }
        if ($matrix[$i][sizeof($matrix[$i])-1] > $max) {
            $max = $matrix[$i][sizeof($matrix[$i])-1];
        }
    }
    return [$min, $max];
}

/**
 * Count the number of elements less than pivot in matrix.
 * Time: O(n*m)
 * Space: O(1)
 */
function elementsLessThan($matrix, $pivot) {
    $less = 0;
    $hasPivotValue = False;

    for ($row=0; $row < sizeof($matrix); $row++) { 
        for ($col=0; $col < sizeof($matrix[$row]); $col++) { 
            if ($matrix[$row][$col] <= $pivot) {
                $less++;
                if ($matrix[$row][$col] == $pivot) {
                    $hasPivotValue = True;
                }
            }
        }
    }
    return [$less, $hasPivotValue];
}

$matrix1 = [
    [1, 3, 5],
    [2, 6, 9],
    [3, 6, 9]
];

$matrix2 = [
    [1, 5, 7],
    [4, 10, 11],
    [8, 11, 12]
];

$matrix3 = [
  [1, 1, 3, 3, 3, 3, 3]
];

echo findMedianBrute($matrix1) . PHP_EOL;
echo findMedian($matrix1) . PHP_EOL; // 5
echo findMedian($matrix2) . PHP_EOL; // 8
echo findMedian($matrix3) . PHP_EOL; // 3