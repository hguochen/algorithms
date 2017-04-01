<?php

// Given an input string, reverse the string word by word.

// Example:

// Given s = "the sky is blue",

// return "blue is sky the".

// A sequence of non-space characters constitutes a word.
// Your reversed string should not contain leading or trailing spaces, even if it is present in the input string.
// If there are multiple spaces between words, reduce them to a single space in the reversed string.

/**
 * Time: O(n)
 * Space: O(n)
 *
 */
function reverseString($string) {
    if (empty($string)) {
        return "";
    }
    $arr = [];
    $temp = "";
    for ($i=0; $i < strlen($string); $i++) { 
        if ($string[$i] != " ") {
            $temp .= $string[$i];
        } elseif (!empty($temp)) {
            array_unshift($arr, $temp);
            $temp = "";
        }
    }
    if (!empty($temp)) {
        array_unshift($arr, $temp);
    }
    return implode(" ", $arr);
}

$str1 = "the sky is blue";

echo reverseString($str1) . PHP_EOL;