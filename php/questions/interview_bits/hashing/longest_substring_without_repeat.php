<?php

// Given a string, 
// find the length of the longest substring without repeating characters.

// Example:

// The longest substring without repeating letters for "abcabcbb" is "abc", which the length is 3.

// For "bbbbb" the longest substring is "b", with the length of 1.

/**
 * Time: O(n) where n is the size of the string
 * Space: O(n)
 *
 */
function longestSubstring($str) {
    if (strlen($str) < 1) {
        return $str;
    }
    $table = [];
    $result = [];
    $i = 0;
    while ($i < strlen($str)) {
        if (!isset($table[$str[$i]])) {
            $table[$str[$i]] = $i;
            $i++;
        } else {
            $i = $table[$str[$i]] + 1;
            $chars = array_keys($table);
            if (sizeof($chars) > sizeof($result)) {
                $result = $chars;
            }
            $chars = [];
            $table = [];
        }
    }
    if (sizeof($table) > 0) {
        $chars = array_keys($table);
        if (sizeof($chars) > sizeof($result)) {
            $result = $chars;
        }
    }
    sort($result);
    return implode("", $result);
}

$str1 = "abcabcbb";
$str2 = "bbbbb";
$str3 = "dadbc";

echo longestSubstring($str1) . PHP_EOL;
echo longestSubstring($str2) . PHP_EOL;
echo longestSubstring($str3) . PHP_EOL;