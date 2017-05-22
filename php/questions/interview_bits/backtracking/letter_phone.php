<?php

// Given a digit string, return all possible letter combinations that the number could represent.

// A mapping of digit to letters (just like on the telephone buttons) is given below.

// The digit 0 maps to 0 itself.
// The digit 1 maps to 1 itself.

// Input: Digit string "23"
// Output: ["ad", "ae", "af", "bd", "be", "bf", "cd", "ce", "cf"].
// Make sure the returned strings are lexicographically sorted.

function letterPhone($digitChars, $str) {
    if (empty($str)) {
        return [];
    }
    $result = [];
    $curr = [];
    letterPhoneRecur($digitChars, $str, $result, $curr, 0);
    $res = array_keys($result);
    return $res;
}

function letterPhoneRecur($digitChars, $str, &$result, &$curr, $idx) {
    if (sizeof($curr) == strlen($str)) {
        $resStr = implode("", $curr);
        if (!isset($result[$resStr])) {
            $result[$resStr] = 1;
        }
        array_pop($curr);
        return;
    }
    $digit = (int) $str[$idx];
    $chars = $digitChars[$digit];
    for ($j=0; $j < strlen($chars); $j++) { 
        $curr[] = $chars[$j];
        letterPhoneRecur($digitChars, $str, $result, $curr, $idx+1);
    }
    array_pop($curr);
}

$digitChars = ["0", "1", "abc", "def", "ghi", "jkl", "mno", "pqrs", "tuv", "wxyz"];

$str1 = "23";
$str2 = "20";
print_r(letterPhone($digitChars, $str1));
print_r(letterPhone($digitChars, $str2));