<?php

// You are given a string, S, and a list of words, L, that are all of the same length.

// Find all starting indices of substring(s) in S that is a concatenation of
// each word in L exactly once and without any intervening characters.

// Example :

// S: "barfoothefoobarman"
// L: ["foo", "bar"]
// You should return the indices: [0,9].
// (order does not matter).

/**
 * 1. put L strings into a hashtable
 * 2. loop through the string S in the length of L strings
 * 3. for each substring, check if there's a match
 * 4.   if yes, store the current index in result
 * 5.   if no, continue to the next step
 * 6. return the result list
 *
 * Time: O(n^2 + m) where n is the size of the string S, m the size of the list L.
 * Space: O(n)
 */
function substrings($S, $L) {
    if (empty($S) || empty($L)) {
        return [];
    }
    $length = strlen($L[0]);
    $table = [];
    for ($i=0; $i < sizeof($L); $i++) { 
        if (!isset($table[$L[$i]])) {
            $table[$L[$i]] = 1;
        } else {
            $table[$L[$i]]++;
        }
    }
    
    $results = [];
    for ($i=0; $i < strlen($S); $i++) { 
        if (containStringsAt($S, $i, $length, $table)) {
            $results[] = $i;
        }
    }
    return $results;
}

function containStringsAt($str, $index, $length, $table) {
    // check if the substr starting at index of length is in table.
    $sub = substr($str, $index, $length);
    if (isset($table[$sub])) {
        $table[$sub] -= 1;
        if ($table[$sub] <= 0) {
            unset($table[$sub]);
        }
        if (empty($table)) {
            return True;
        }
    } else {
        return False;
    }

    for ($i=$index+$length; $i < strlen($str); $i += $length) { 
        $sub = substr($str, $i,$length);
        if (isset($table[$sub])) {
            $table[$sub] -= 1;
            if ($table[$sub] <= 0) {
                unset($table[$sub]);
            }
            if (empty($table)) {
                return True;
            }
        } else {
            return False;
        }
    }
    return False;
}

$S = "barfoothefoobarman";
$L = ["foo", "bar"];

$s1 = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
$l1 = [ "aaa", "aaa", "aaa", "aaa", "aaa" ];

print_r(substrings($S, $L));
print_r(substrings($s1, $l1));
