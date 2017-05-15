<?php

// Given n pairs of parentheses, write a function to generate all combinations of well-formed parentheses of length 2*n.

// For example, given n = 3, a solution set is:

// "((()))", "(()())", "(())()", "()(())", "()()()"
// Make sure the returned list of strings are sorted.

/**
 * Time: O(2^n)
 * Space: O(2^n)
 *
 */
function generateParentheses($n) {
    if ($n < 1) {
        return [];
    }
    $result = [];
    $curr = [];
    generateParenthesesRecur($n, $result, $curr, 0);
    return array_reverse($result);
}

function generateParenthesesRecur($n, &$result, &$curr, $val) {
    if ($val == $n) {
        return;
    }
    if (empty($result)) {
        $curr[] = "()";
    } else {
        for ($i=0; $i < sizeof($result); $i++) { 
            for ($j=0; $j < strlen($result[$i]); $j++) { 
                $temp = substr_replace($result[$i], "()", $j, 0);
                if (!in_array($temp, $curr)) {
                    $curr[] = $temp;
                }
            }        
        }
    }
    $result = $curr;
    $curr = [];
    generateParenthesesRecur($n, $result, $curr, $val+1);
}


print_r(generateParentheses(3));