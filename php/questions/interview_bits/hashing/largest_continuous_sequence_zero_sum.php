<?php

// Find the largest continuous sequence in a array which sums to zero.

// Example:


// Input:  {1 ,2 ,-2 ,4 ,-4}
// Output: {2 ,-2 ,4 ,-4}

//  NOTE : If there are multiple correct answers, return the sequence which occurs first in the array. 

function largestSequence($arr) {
    if (empty($arr)) {
        return [];
    }
    $result = [];
    $left = NULL;
    $right = NULL;
    for ($i=0; $i < sizeof($arr); $i++) { 
        $temp = $arr[$i];
        if ($temp == 0 && is_null($left) && is_null($right)) {
            $left = $i;
            $right = $i;
        }
        for ($j=$i + 1; $j < sizeof($arr); $j++) { 
            $temp += $arr[$j];
            if ($temp == 0) {
                if ($right - $left < $j - $i) {
                    $left = $i;
                    $right = $j;    
                }
            }
        }
    }
    for ($i=$left; $i <= $right; $i++) { 
        $result[] = $arr[$i];
    }
    return $result;
}

/**
 * OPTIMAL.
 * 1. setup a cumulative array of the given array
 * eg. [1,2,-2,4,-4]
 * cum:[1,3,1,5,1]
 * 2. In the cumulative array, if the ith and jth index element are equal, then
 * i+1th to jth index cumulates to 0.
 * 3. if any element of the cumulative array is 0, the range is 0 to ith index.
 * 4. we use a hash table to find the set of equal left and right index elements
 * 5. return the left and right sub array elements.
 *
 * Time: O(n) where n is the size of the array.
 * Space: O(n)
 */
function largestSequenceV2($arr) {
    if (empty($arr)) {
        return [];
    }
    $sumValue = 0;
    $sums = [];
    for ($i=0; $i < sizeof($arr); $i++) { 
        $sumValue += $arr[$i];
        $sums[] = $sumValue;
    }
    $left = NULL;
    $right = NULL;
    $table = [];

    for ($i=0; $i < sizeof($sums); $i++) { 
        if ($sums[$i] == 0) {
            $left = 0;
            $right = $i;
        } elseif (!isset($table[$sums[$i]])) {
            $table[$sums[$i]] = $i;
        } else {
            if (is_null($left) && is_null($right)) {
                $left = $table[$sums[$i]] + 1;
                $right = $i;
            } elseif (!empty($left) and $right - $left < $i - $table[$sums[$i]] - 1) {
                $left = $table[$sums[$i]] + 1;
                $right = $i;
            }
        }
    }

    $result = [];
    if (is_null($left)) {
        return [];
    }
    for ($i=$left; $i <= $right; $i++) { 
        $result[] = $arr[$i];
    }
    return $result;
}

$arr1 = [1 ,2 ,-2 ,4 ,-4];
$arr2 = [ 1, 2, -1, 1, 3, -1, 1, 4 ];
print_r(largestSequence($arr1));
print_r(largestSequence($arr2));
print_r(largestSequenceV2($arr1));
print_r(largestSequenceV2($arr2));