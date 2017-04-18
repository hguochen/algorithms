<?php

// For Given Number N find if its COLORFUL number or not

// Return 0/1

// COLORFUL number:

// A number can be broken into different contiguous sub-subsequence parts. 
// Suppose, a number 3245 can be broken into parts like 3 2 4 5 32 24 45 324 245. 
// And this number is a COLORFUL number, since product of every digit of a contiguous subsequence is different
// Example:

// N = 23
// 2 3 23
// 2 -> 2
// 3 -> 3
// 23 -> 6
// this number is a COLORFUL number since product of every digit of a sub-sequence are different. 

// Output : 1

/**
 * Time: O(2^n) where n is the length of the num.
 * Space: O(2^n)
 *
 */
function isColorfulNumber($num) {
    $num = (string)$num;
    $parts = [];
    $size = 1;
    while ($size <= strlen($num)) {
        for ($i=0; $i < strlen($num); $i++) { 
            $sub = substr($num, $i, $size);
            if (strlen($sub) == $size) {
                $parts[] = $sub;
            }
        }
        $size++;
    }
    $table = [];
    for ($i=0; $i < sizeof($parts); $i++) { 
        $value = 1;
        for ($j=0; $j < strlen($parts[$i]); $j++) { 
            $value *= (int)$parts[$i][$j];
        }
        if (!isset($table[$value])) {
            $table[$value] = 1;
        } else {
            return 0;
        }
    }
    return 1;
}

$num1 = 3245;
$num2 = 23;
$num3 = 99;

echo isColorfulNumber($num1) . PHP_EOL;
echo isColorfulNumber($num2) . PHP_EOL;
echo isColorfulNumber($num3) . PHP_EOL;