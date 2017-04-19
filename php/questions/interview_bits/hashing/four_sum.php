<?php

// Given an array S of n integers, are there elements a, b, c, and d in S such
// that a + b + c + d = target? Find all unique quadruplets in the array which gives the sum of target.

//  Note:
// Elements in a quadruplet (a,b,c,d) must be in non-descending order. (ie, a ≤ b ≤ c ≤ d)
// The solution set must not contain duplicate quadruplets.
// Example : 
// Given array S = {1 0 -1 0 -2 2}, and target = 0
// A solution set is:

//     (-2, -1, 1, 2)
//     (-2,  0, 0, 2)
//     (-1,  0, 0, 1)
// Also make sure that the solution set is lexicographically sorted.
// Solution[i] < Solution[j] iff Solution[i][0] < Solution[j][0] OR
// (Solution[i][0] == Solution[j][0] AND ... Solution[i][k] < Solution[j][k])

/**
 * Time: O(n^3)
 * Space: O(2^n)
 *
 */
function fourSum($arr, $target) {
    if (empty($arr) || sizeof($arr) < 4) {
        return [];
    }
    sort($arr);
    $results = [];
    for ($i=0; $i < sizeof($arr); $i++) { 
        $value = $target - $arr[$i];
        $sub = array_slice($arr, $i+1);
        $res = threeSum($sub, $value);
        if (!empty($res)) {
            for ($j=0; $j < sizeof($res); $j++) { 
                $ans = [$arr[$i], $res[$j][0], $res[$j][1], $res[$j][2]];
                if (!in_array($ans, $results)) {
                    $results[] = $ans;
                }
            }
        }
    }
    return $results;
}

/**
 * Time: O(n^2)
 * Space: O(2^n)
 *
 */
function threeSum($arr, $target) {
    if (empty($arr) || sizeof($arr) < 3) {
        return [];
    }
    $result = [];
    for ($i=0; $i < sizeof($arr); $i++) { 
        $value = $target - $arr[$i];
        $sub = array_slice($arr, $i + 1);
        $res = twoSum($sub, $value);
        if (!empty($res)) {
            for ($j=0; $j < sizeof($res); $j++) { 
                $result[] = [$arr[$i], $res[$j][0], $res[$j][1]];    
            }
        }
    }
    return $result;
}

/**
 * Arr is sorted. use the two pointer approach.
 * Time: O(n)
 * Space: O(2^n)
 *
 */
function twoSum($arr, $target) {
    if (empty($arr) || sizeof($arr) < 2) {
        return [];
    }
    $result = [];
    for ($i=0; $i < sizeof($arr); $i++) { 
        for ($j=$i+1; $j < sizeof($arr); $j++) { 
            if ($arr[$i] + $arr[$j] == $target) {
                $result[] = [$arr[$i], $arr[$j]];
            }
        }
    }
    $i = 0;
    $j = sizeof($arr) - 1;
    while ($i < $j) {
        if ($arr[$i] + $arr[$j] == $target) {
            $result[] = [$arr[$i], $arr[$j]];
            $i++;
            $j--;
        } elseif ($arr[$i] + $arr[$j] > $target) {
            $j--;
        } else {
            $i++;
        }
    }
    return $result;
}

$arr1 = [1, 0, -1, 0, -2, 2];
$arr2 = [ 9, -8, -10, -7, 7, -8, 2, -7, 4, 7, 0, -3, -4, -5, -1, -4, 5, 8, 1, 9, -2, 5, 10, -5, -7, -1, -6, 4, 1, -5, 3, 8, -4, -10, -9, -3, 10, 0, 7, 9, -8, 10, -9, 7, 8, 0, 6, -6, -7, 6, -4, 2, 0, 10, 1, -2, 5, -2 ];

print_r(fourSum($arr1, 0));
print_r(fourSum($arr2, 0));
