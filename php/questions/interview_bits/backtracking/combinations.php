<?php

// Given two integers n and k, return all possible combinations of k numbers out of 1 2 3 ... n.

// Make sure the combinations are sorted.

// To elaborate,
// 1. Within every entry, elements should be sorted. [1, 4] is a valid entry while [4, 1] is not.
// 2. Entries should be sorted within themselves.

// Example :
// If n = 4 and k = 2, a solution is:

// [
//   [1,2],
//   [1,3],
//   [1,4],
//   [2,3],
//   [2,4],
//   [3,4],
// ]

function combinations($n, $k) {
    if ($n < 1) {
        return;
    } 
    $arr = generateArray($n);
    $result = [];
    $temp = [];
    generate($arr, $result, $temp, 0, $k);
    return $result;
}

/**
 * Time: O(2*n)
 * Space: O(2*n)
 *
 */
function generate($arr, &$result, &$temp, $index, $k) {
    // if temp has solution size, put into result and stop here
    if (isSolution($temp, $k)) {
        $result[] = $temp;
        return;
    }
    // if index is out of bounds, stop here. base case
    if ($index == sizeof($arr)) {
        return;
    }
    // for each of the element candidates, we try to construct a solution by first
    // appending the current element to the solution. then recurse from the next element onwards.
    // the solution size check will catch when $k elements are placed inside temp and stop
    // once the recursion returns to the calling function, we know all solutions for the current element
    // are in results, then we BACKTRACK to remove current element from the solution and proceed with for loop
    // to do the same with next iteration.
    for ($i=$index; $i < sizeof($arr); $i++) { 
        $temp[] = $arr[$i];
        generate($arr, $result, $temp, $i+1, $k);
        array_pop($temp);
    }
}

function constructCandidates($arr, $temp, $index) {
    if (empty($temp)) {
        return $arr;
    }
    return array_slice($arr, $index+1);
}

function isSolution($temp, $k) {
    return sizeof($temp) == $k;
}

function generateArray($n) {
    $arr = [];
    for ($i=1; $i <= $n; $i++) { 
        $arr[] = $i;
    }
    return $arr;
}

print_r(combinations(4, 2));
print_r(combinations(4, 3));
