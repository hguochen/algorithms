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
    // add new char to each of the result elements
    foreach ($result as $value) {
        $value[] = $array[$index];
        $temp[] = $value;
    }
    // put elements into result if its new
    foreach ($temp as $set) {
        if (!in_array($set, $result)) {
            $result[] = $set;
        }
    }
    generatePowersetHelper($array, $result, ++$index);
}

/**
 * Recursive approach to generating powersets without using for loop in recursion.
 * Time: O(2^n * n)
 * Space: O(2^n * n)
 */
function generatePowersetsRecursionV2($array) {
    $result = [[]];
    if (empty($array)) {
        return $result;
    }
    for ($i=0; $i < sizeof($array); $i++) { 
        generatePowersetHelperV2($array, $result, 0, $i);
    }

    return $result;
}

function generatePowersetHelperV2($array, &$result, $resultIndex, $arrayIndex) {
    // if current result element already has the new char, terminate
    if (in_array($array[$arrayIndex], $result[$resultIndex])) {
        if (!in_array([], $result)) {
            $result[] = [];
        }
        return;
    }
    // new element is not in current result
    // append new element to end of current result element
    $temp = $result[$resultIndex];
    $temp[] = $array[$arrayIndex];
    if (!in_array($temp, $result)) {
        $result[] = $temp;
    }
    
    generatePowersetHelperV2($array, $result, ++$resultIndex, $arrayIndex);
}




$arr1 = ['A', 'B', 'C', 'D', 'E'];

// print_r(generatePowersets($arr1));
// print_r(generatePowersetsRecursion($arr1));
print_r(generatePowersetsRecursionV2($arr1));