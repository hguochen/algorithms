<?php

// https://www.interviewbit.com/problems/anagrams/
// Given an array of strings, return all groups of strings that are anagrams.
// Represent a group by a list of integers representing the index in the original
// list. Look at the sample case for clarification.

//  Anagram : a word, phrase, or name formed by rearranging the letters of
//  another, such as 'spar', formed from 'rasp' 
//  Note: All inputs will be in lower-case. 
// Example :

// Input : cat dog god tca
// Output : [[1, 4], [2, 3]]
// cat and tca are anagrams which correspond to index 1 and 4. 
// dog and god are another set of anagrams which correspond to index 2 and 3.
// The indices are 1 based ( the first element has index 1 instead of index 0).

//  Ordering of the result : You should not change the relative ordering of the
//  words / phrases within the group. Within a group containing A[i] and A[j],
//  A[i] comes before A[j] if i < j. 

/**
 * Time: O(n * mlogm)
 * O(n) where n is the size of the input array
 * O(mlogm) where n is the size of the longest string in array, a comparison sorting
 * algorithm gives us O(mlogm) 
 *
 * Space: O(n * m)
 */
function findAnagrams($arr) {
    if (empty($arr)) {
        return [];
    }
    $table = [];
    for ($i=0; $i < sizeof($arr); $i++) { 
        $sorted = sortChars($arr[$i]);
        if (isset($table[$sorted])) {
            $table[$sorted][] = $i + 1;
        } else {
            $table[$sorted] = [$i+1];
        }
    }
    $result = [];
    foreach ($table as $key => $value) {
        $result[] = $value;
    }
    return $result;
}

/**
 * Time: O(mlogm)
 * Space: O(m)
 */
function sortChars($str) {
    if (empty($str)) {
        return "";
    }
    $result = [];
    for ($i=0; $i < strlen($str); $i++) { 
        $result[] = $str[$i];
    }
    sort($result);
    return implode("", $result);
}

$arr1 = ["cat", "dog", "god", "tca"];

print_r(findAnagrams($arr1));