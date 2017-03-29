<?php

// Implement pow(x, n) % d.

// In other words, given x, n and d,

// find (xn % d)

// Note that remainders on division cannot be negative. 
// In other words, make sure the answer you return is non negative.

// Input : x = 2, n = 3, d = 3
// Output : 2

// 2^3 % 3 = 8 % 3 = 2.

/**
 * [powBrute description]
 * 1. compute the power by multiplying x by n times.
 * 2. divide the previous by d.
 *
 * Time: O(n) where n is $n value.
 * Space: O(1)
 */
function powBrute($x, $n, $d) {
    $powerResult = 1;
    for ($i=0; $i < $n; $i++) { 
        $powerResult *= $x;
    }
    $quotient = floor($powerResult / $d);
    return $powerResult - ($quotient * $d);
}

/**
 * First optimization. Prevent overflow.
 * x % d to get each modulo. then multiply the modulos and %d again to get the result
 * whenever mod is larger than $d, reduce to mod value again
 * Time: O(n)
 * Space: O(1)
 */
function powV2($x, $n, $d) {
    if ($x == 0) {
        return 0;
    } elseif ($n == 0) {
        return 1;
    }
    $quotient = floor($x / $d);
    $mod = $x - $quotient * $d;
    $modMultiplied = 1;
    for ($i=0; $i < $n; $i++) { 
        $modMultiplied *= $mod;
        if ($modMultiplied > $d) {
            $quotient = floor($modMultiplied / $d);
            $modMultiplied -= $quotient * $d;
        }
    }
    // $quotient = floor($modMultiplied / $d);
    // return $modMultiplied - ($quotient * $d);
    return $modMultiplied;
}

/**
 * OPTIMAL
 * Exponentiation by squaring. Uses the binary search idea, each time increase
 * the power by the power exponential.
 * This works because each time the exponential is divided by 2. the base increases
 * by exponential 2. So the base is continually updated with the exponent divided
 * by 2 each time.
 * And when the digit bit is set at 1. we multiply the base so far to the result.
 *  
 * 
 * Time: O(logn) where n is the exponential
 * Space: O(1)
 */
function powV3($x, $n, $d) {
    if ($x == 0) {
        return 0;
    }
    if ($n == 0) {
        return 1;
    }
    $result = 1;
    // loop through all the binary digits of exponential
    while ($n > 0) {
        // if current digit bit is 1, result * base
        if ($n & 1) {
            $result = $result * $x % $d;
        }
        // divide the exponential by 2
        $n >>= 1;
        $x *= $x;
        // prevent overflow
        $x %= $d;
    }
    return $result;
}

echo powBrute(2,3,3) . PHP_EOL;
echo powV2(2,3,3) . PHP_EOL;

echo powBrute(4,6,11) . PHP_EOL;
echo powV2(4,6,11) . PHP_EOL;

echo powBrute(243, 5453, 19) . PHP_EOL;
echo powV2(243, 5453, 19) . PHP_EOL;
echo powV3(243, 5453, 19) . PHP_EOL;

echo powV3(71045970, 41535484, 64735492) . PHP_EOL;
