<?php

// Given two integers representing the numerator and denominator of a fraction,
// return the fraction in string format.

// If the fractional part is repeating, enclose the repeating part in parentheses.

// Example :

// Given numerator = 1, denominator = 2, return "0.5"
// Given numerator = 2, denominator = 1, return "2"
// Given numerator = 2, denominator = 3, return "0.(6)"

/**
 * OPTIMAL.
 * 1. take care of case when num or den is -ve. result will be -ve.
 * 2. handle num and den as absolute numbers
 * 3. num / den and put the integral into result
 * 4. if num & den is 0. return result immediately
 * 5. init a table with key as mod integer and value as the current index in result
 * 5. loop as long as mod value is not 0
 * 6.   put divided integral into result
 * 7.   if mod value is in table
 *         put ( and ) around the current number
 *         and return result
 *      else
 *          put table[quotient] = size of result
 * 8. return result
 *
 * Time: O(n) where n is the size of the non repeating integers after decimal place.
 * Space: O(n)
 */
function fraction($num, $den) {
    if ($num == 0) {
        return "0";
    }   
    $result = "";
    // take care of -ve numbers
    if (($num < 0 && $den > 0) || ($num > 0 && $den < 0)) {
        $result .= "-";
    }
    // handle num and den as positive numbers
    $num = abs($num);
    $den = abs($den);

    $integral = (int) ($num / $den);
    $result .= $integral;
    $num %= $den;
    if ($num == 0) {
        return $result;
    }
    $result .= ".";

    $table = [];
    $table[$num] = strlen($result);
    while ($num != 0) {
        $num *= 10;
        $integral = (int)($num / $den);
        $result .= $integral;
        $num %= $den;
        if (isset($table[$num])) {
            $result = substr_replace($result, "(", $table[$num], 0);
            $result .= ")";
            break;
        } else {
            $table[$num] = strlen($result);
        }
    }

    return $result;
}

echo 
fraction(1, 2) . PHP_EOL;
echo 
fraction(-2, 1) . PHP_EOL;
echo 
fraction(2, 3) . PHP_EOL;
