<?php

// Given a string S and a string T, find the minimum window in S which will
// contain all the characters in T in linear time complexity.
// Note that when the count of a character C in T is N, then the count of C in
// minimum window in S should be at least N.

// Example :

// S = "ADOBECODEBANC"
// T = "ABC"
// Minimum window is "BANC"

//  Note:
// If there is no such window in S that covers all characters in T, return the
// empty string ''.
// If there are multiple such windows, return the first occurring minimum window
// ( with minimum start index ).

/**
 * OPTIMAL
 * Time: O(n) where n is the size of string A.
 * Space: O(m) where m is the size of string B.
 *
 */
function minWindowV2($strA, $strB) {
    if (empty($strA) || empty($strB)) {
        return "";
    }
    $table = [];
    for ($i=0; $i < strlen($strB); $i++) { 
        if (!isset($table[$strB[$i]])) {
            $table[$strB[$i]] = 1;
        } else {
            $table[$strB[$i]]++;
        }
    }

    $left = 0;
    $right = 0;
    $result = "";
    while (True) {
        $sub = substr($strA, $left, $right - $left + 1);
        if (containChars($table, $sub)) {
            if (strlen($result) == 0 || strlen($sub) < strlen($result)) {
                $result = $sub;
            }
            $left++;
        } else {
            if ($right < strlen($strA)) {
                $right++;
            } else {
                $left++;
            }
        }
        if ($right >= strlen($strA) && $left == $right) {
            break;
        }
    }
    return $result;
}

function containChars($table, $str) {
    if (empty($str)) {
        return False;
    }
    $temp = $table;
    for ($i=0; $i < strlen($str); $i++) { 
        if (isset($temp[$str[$i]])) {
            if ($temp[$str[$i]] == 1) {
                unset($temp[$str[$i]]);
            } else {
                $temp[$str[$i]]--;
            }
        }
    }
    if (empty($temp)) {
        return True;
    }
    return False;
}

/**
 * 
 * Assume $strB has no repeating characters.
 * 
 * Time: O(n)
 * Space: O(n)
 */
function minWindow($strA, $strB) {
    if (empty($strA) || empty($strB)) {
        return "";
    }
    $table = [];
    for ($i=0; $i < strlen($strB); $i++) { 
        $table[$strB[$i]] = [];
    }
    $positions = $table;
    $result = $table;
    for ($i=0; $i < strlen($strA); $i++) { 
        if (isset($table[$strA[$i]])) {
            $table[$strA[$i]][] = $i;
        }
    }
    foreach ($table as $key => $value) {
        if (sizeof($table[$key]) > 0) {
            $value = array_shift($table[$key]);
            $positions[$key] = $value;
            if (empty($table[$key])) {
                unset($table[$key]);
            }
        } else {
            return "";
        }
    }
    $minDist = max($positions) - min($positions) + 1;

    while (!empty($table)) {
        $char = array_search(min($positions), $positions);
        if (!empty($table[$char])) {
            $positions[$char] = array_shift($table[$char]);
        }
        if (empty($table[$char])) {
            unset($table[$char]);
        }
        $temp = max($positions) - min($positions) + 1;
        if ($temp < $minDist) {
            $minDist = $temp;
            $result = $positions;
        }
    }
    $leftIndex = min($result);
    $rightIndex = max($result);
    return substr($strA, $leftIndex, $rightIndex - $leftIndex + 1);
}

$str1 = "ADOBECODEBANC";
$str2 = "ABC";
$str3 = "AAAAAA";
$str4 = "AA";
echo minWindow($str1, $str2) . PHP_EOL;
echo minWindowV2($str1, $str2) . PHP_EOL;
echo minWindowV2($str3, $str4) . PHP_EOL;