<?php

/**
 * Find the longest palindrome substring.
 * Brute force.
 * Get every substring and check if its a palindrome. Update the longest
 * palindrome if required.
 * Time complexity: O(n^3)
 * Space complexity: O(1)
 */
function longestPalindrome($string) {
    if (empty($string)) {
        return;
    }
    $result = "";
    for ($i=0; $i < strlen($string)-1; $i++) {

        for ($j=$i+1; $j < strlen($string); $j++) { 
            $sub = substr($string, $i, $j-$i+1);
            if (isPalindrome($sub) && strlen($sub) > strlen($result)) {
                $result = $sub;
            }
        }
    }
    return $result;
}

function longestPalindromeV2($string) {
    if (empty($string)) {
        return;
    }
    $result = "";
    $adjusted = "*";
    for ($i=0; $i < strlen($string); $i++) { 
        $adjusted .= $string[$i] . "*";
    }

    for ($j=0; $j < strlen($adjusted); $j++) { 
        $i=$j;
        $k=$j;
        while ($i >= 0 && $k <= strlen($adjusted)-1) {
            $sub = substr($adjusted, $i, $k-$i+1);
            if (isPalindrome($sub)) {
                if (strlen($sub) > strlen($result)) {
                    $result = $sub;
                }
                $i -= 1;
                $k += 1;
            } else {
                break;
            }
        }
    }
    return str_replace("*", "", $result);
}

/**
 * Given a string check if it is a palindrome.
 */
function isPalindrome($string) {
    return _isPalindrome($string, 0, strlen($string)-1);
}

function _isPalindrome($string, $firstIndex, $lastIndex) {
    if ($firstIndex >= $lastIndex) {
        return True;
    }
    if ($string[$firstIndex] !== $string[$lastIndex]) {
        return False;
    } else {
        return _isPalindrome($string, $firstIndex+1, $lastIndex-1);
    }
}


$string1 = "abba";
$string2 = "abbccbba";
$string3 = "geeks";
$string4 = "civic";
$string5 = "forgeeksskeegfor";
// echo isPalindrome($string1, 0, strlen($string1)-1) . PHP_EOL; // true
// echo isPalindrome($string2, 0, strlen($string2)-1) . PHP_EOL; // true
// echo isPalindrome($string3, 0, strlen($string3)-1) . PHP_EOL; // false
// echo isPalindrome($string4, 0, strlen($string4)-1) . PHP_EOL; // true

// echo longestPalindrome($string5) . PHP_EOL;

echo longestPalindromeV2($string1) . PHP_EOL;
echo longestPalindromeV2($string2) . PHP_EOL;
echo longestPalindromeV2($string3) . PHP_EOL;
echo longestPalindromeV2($string4) . PHP_EOL;
echo longestPalindromeV2($string5) . PHP_EOL;
