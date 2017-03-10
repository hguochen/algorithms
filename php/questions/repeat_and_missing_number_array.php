<?php

// You are given a read only array of n integers from 1 to n.
// Each integer appears exactly once except A which appears twice and B which is missing.
// Return A and B.

// Note: Your algorithm should have a linear runtime complexity.
// Could you implement it without using extra memory?

// Note that in your output A should precede B.

// Example:
// Input:[3 1 2 5 3] 
// Output:[3, 4] 
// A = 3, B = 4

function findRepeatAndMissing($arr) {
    if (empty($arr)) {
        return;
    }
    // use index to set flag as element is present in array 
    for ($i=0; $i < sizeof($arr); $i++) { 
        $index = abs($arr[$i]) - 1;
        if ($arr[$index] > 0) {
            $arr[$index] = -$arr[$index];
        } else {
            $result[] = abs($arr[$i]);
        }
    }
    // find the first +ve element, its index+1 is the missing element 
    for ($i=0; $i < sizeof($arr); $i++) { 
        if ($arr[$i] > 0) {
            $result[] = $i + 1;
            break;
        }
    }
    return $result;
}

$arr1 = [3,1,2,5,3];

print_r(findRepeatAndMissing($arr1));