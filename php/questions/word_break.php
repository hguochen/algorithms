<?php

/**
 * Given a non-empty string s and a dictionary wordDict containing a list of
 * non-empty words, determine if s can be segmented into a space-separated
 * sequence of one or more dictionary words. You may assume the dictionary does
 * not contain duplicate words.
 *
 * For example, given
 * s = "leetcode",
 * dict = ["leet", "code"].
 * 
 * Return true because "leetcode" can be segmented as "leet code".
 */

/**
 * Checks if the given string can be broken down in all valid word.
 * 
 * Time: complexity of validWordHelper method
 * Space: O(1)
 */
function validWord($str, $dict) {
    if (empty($str)) {
        return False;
    }
    return validWordHelper($str, $dict, 0);
}

/**
 * Recursion on validWord method.
 * Time: O(n^2 * n!)
 * where n is the size of string
 * n^2 is contributed by looping through the string and constructing a substring in each iteration.
 * n! is contributed by recursively adding to the stack frame for new method calls
 */
function validWordHelper($str, $dict, $index) {
    if ($index == strlen($str)) {
        return True;
    }
    for ($i=$index; $i < strlen($str); $i++) { 
        $newStr = substr($str, $index, $i-$index+1);
        if (isset($dict[$newStr])) {
            if (validWordHelper($str, $dict, $i+1)) {
                return True;
            }
        }
    }
    return False;
}

function validWordDP($str, $dict) {
    if (empty($str)) {
        return False;
    }
    $table = [];
    return validWordHelperDP($str, $dict, $table, 0);
}

/**
 * Dynamic programming approach.
 * Time: O(n^2 * n^2)
 * first n^2 contributed by looping through the string and constructing a substring in each iteration
 * second n^2 contributed by recursively adding to stack frame and using the already computed DP solution.
 */
function validWordHelperDP($str, $dict, &$table, $index) {
    if ($index == strlen($str)) {
        return True;
    }
    if (gettype($table[$index]) == 'boolean') {
        return $table[$index];
    }
    for ($i=$index; $i < strlen($str); $i++) { 
        $newStr = substr($str, $index, $i-$index+1);
        if (isset($dict[$newStr])) {
            if (validWordHelperDP($str, $dict, $table, $i+1)) {
                return True;
            }
        }
    }
    $table[$index] = False;
    return $table[$index];
}

/**
 * Given a string and a dictionary, break the string into its valid words
 * delimited by space. If there are invalid words, return empty string.
 * Time: O(n + constructWord complexity)
 * Space: O(n)
 * where n is the size of the string
 */
function wordBreak($str, $dict) {
    if (empty($str)) {
        return "";
    }
    $result = [];
    constructWords($str, $dict, $result, 0);
    if (empty($result)) {
        return "";
    }
    // check if result has all the input strings
    $count = 0;
    for ($i=0; $i < sizeof($result); $i++) { 
        $count += strlen($result[$i]);
    }

    if ($count == strlen($str)) {
        return implode(" ", $result);
    } else {
        return "";
    }    
}

/**
 * Construct words in the given string.
 * - loop through given string
 * - if a valid word is found, store current valid word in temp variable and recurse
 * on the rest of the word.
 * - put put valid word in result only once.
 * 
 * Time: O(n^2 * n!)
 * Space: O(n)
 */
function constructWords($str, $dict, &$result, $index) {
    if ($index == strlen($str)) {
        return;
    }
    $temp = "";
    for ($i=$index; $i < strlen($str); $i++) { 
        $sub = substr($str, $index, $i-$index+1);
        if (isset($dict[$sub])) {
            if (strlen($temp) < strlen($sub)) {
                $temp = $sub;
            }
            // boolean check to determine if subsequent chars has been used to
            // construct another valid word.
            $wordAdded = constructWords($str, $dict, $result, $i+1);
        }
        // subsequent chars used to construct another word, do not continue        
        if ($wordAdded) {
            break;
        }
    }
    // put current temp into result
    if (!empty($temp)) {
        array_unshift($result, $temp);
        return True;
    }
    return False;
}

$dict = [
    "leet" => 1,
    "code" => 1,    
];

$dict2 = [
    "a" => 1,
    "aa" => 1,    
    "aaa" => 1,    
    "aaaa" => 1,    
];

$dict3 = [
    "this" => 1,
    "is" => 1,    
    "a" => 1,
    "as" => 1,
    "string" => 1,    
];

$str1 = "leetcode";
$str2 = "aaaab";
$str3 = "thisisastring";

echo wordBreak($str1, $dict) . PHP_EOL;
echo wordBreak($str2, $dict2) . PHP_EOL;
echo wordBreak($str3, $dict3) . PHP_EOL;


// $starttime = microtime(true);
// echo validWord($str1, $dict) . PHP_EOL;
// $endtime = microtime(true);
// $timediff = $endtime - $starttime;
// echo "execution time: " . $timediff * 1000000 . PHP_EOL;

// $starttime = microtime(true);
// echo validWord($str2, $dict2) . PHP_EOL;
// $endtime = microtime(true);
// $timediff = $endtime - $starttime;
// echo "execution time: " . $timediff * 1000000 . PHP_EOL;

// $starttime = microtime(true);
// echo validWord($str3, $dict3) . PHP_EOL;
// $endtime = microtime(true);
// $timediff = $endtime - $starttime;
// echo "execution time: " . $timediff * 1000000 . PHP_EOL;

// // DP optimizations
// // 
// $starttime = microtime(true);
// echo validWordDP($str1, $dict) . PHP_EOL;
// $endtime = microtime(true);
// $timediff = $endtime - $starttime;
// echo "execution time: " . $timediff * 1000000 . PHP_EOL;

// $starttime = microtime(true);
// echo validWordDP($str2, $dict2) . PHP_EOL;
// $endtime = microtime(true);
// $timediff = $endtime - $starttime;
// echo "execution time: " . $timediff * 1000000 . PHP_EOL;

// $starttime = microtime(true);
// echo validWordDP($str3, $dict3) . PHP_EOL;
// $endtime = microtime(true);
// $timediff = $endtime - $starttime;
// echo "execution time: " . $timediff * 1000000 . PHP_EOL;
