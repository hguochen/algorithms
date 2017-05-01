<?php

// Implement pow(A, B) % C.

// In other words, given A, B and C, 
// find (AB)%C.

// Input : A = 2, B = 3, C = 3
// Return : 2 
// 2^3 % 3 = 8 % 3 = 2

/**
 * OPTIMAL
 * Time: O(logn)
 * Space: O(1)
 *
 */
function mod($A, $B, $C) {
    if ($B == 0) {
        if ($A == 0) {
            return 0; 
        }
        return 1;
    }
    if ($B % 2 == 0) {
        $val = mod($A, $B/2, $C);
        return ($val * $val) % $C;
    } else {
        return (($A % $C) * mod($A, $B-1, $C)) % $C;
    }
}

echo mod(2,3,3) . PHP_EOL;