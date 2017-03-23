<?php

/**
 * Given an array of characters, generate every combination of character sequence.
 */

/**
 * Iterative approach to generating powersets.
 * Time: O(2^n * n)
 * Space: O(2^n * n)
 */
function generatePowersets($array) {
    $result = [[]];
    if (empty($array)) {
        return $result;
    }
    for ($i=0; $i < sizeof($array); $i++) { 
        $temp = [[]];
        foreach ($result as $value) {
            $value[] = $array[$i];
            $temp[] = $value;
        }
        foreach ($temp as $set) {
            if (!in_array($set, $result)) {
                $result[] = $set;
            }
        }
    }
    return $result;
}

/**
 * Recursive approach to generating powersets.
 * Time: O(2^n * n)
 * Space: O(2^n * n)
 */
function generatePowersetsRecursion($array) {
    $result = [[]];
    if (empty($array)) {
        return $result;
    }
    generatePowersetHelper($array, $result, 0);
    return $result;
}

function generatePowersetHelper($array, &$result, $index) {
    if ($index >= sizeof($array)) {
        return;
    }
    $temp = [[]];
    foreach ($result as $value) {
        $value[] = $array[$index];
        $temp[] = $value;
    }
    foreach ($temp as $set) {
        if (!in_array($set, $result)) {
            $result[] = $set;
        }
    }
    generatePowersetHelper($array, $result, ++$index);
}

$arr1 = ['A', 'B', 'C', 'D', 'E'];

print_r(generatePowersets($arr1));
print_r(generatePowersetsRecursion($arr1));