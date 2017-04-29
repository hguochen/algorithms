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

function windowString($str1, $str2) {
    if (empty($str1) || empty($str2)) {
        return "";
    }
    $expected = [];
    for ($i=0; $i < strlen($str2); $i++) { 
        if (!isset($expected[$str2[$i]])) {
            $expected[$str2[$i]] = 1;
        } else {
            $expected[$str2[$i]]++;
        }
    }
    $actual = [];
    list($left, $right) = [0, 0];
    $result = []; // start and end index of the result string.
    while ($left < strlen($str1) && $right < strlen($str1)) {
        // all chars in str2 are in current left right boundaries in str1
        if (sizeof($expected) == sizeof($actual)) {
            // move ahead left pointer as long as char is not in expected table
            while (!isset($expected[$str1[$left]])) {
                $left++;
            }
            // left is now pointing to the first char that's also in expected
            if (empty($result) || $result[1] - $result[0] > $right - $left) {
                $result = [$left, $right];
            }
            // unset the char in actual table.
            if ($actual[$str1[$left]] == 1) {
                unset($actual[$str1[$left]]);
            } else {
                $actual[$str1[$left]]--;
            }
            $left++;
        } else { // not all chars are in yet
            if (isset($expected[$str1[$right]])) {
                if (!isset($actual[$str1[$right]])) {
                    $actual[$str1[$right]] = 1;
                } else {
                    $actual[$str1[$right]]++;
                }
            }
            if ($right < strlen($str1)-1) {
                $right++;
            } else {
                $left++;
            }
        }
    }
    return substr($str1, $result[0], $result[1] - $result[0]+1);
}

$str1 = "ADOBECODEBANC";
$str2 = "ABC";

echo windowString($str1, $str2);