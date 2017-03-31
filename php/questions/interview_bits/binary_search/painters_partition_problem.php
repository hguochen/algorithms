<?php

// You have to paint N boards of length {A0, A1, A2, A3 … AN-1}. There are K
// painters available and you are also given how much time a painter takes to
// paint 1 unit of board. You have to get this job done as soon as possible
// under the constraints that any painter will only paint contiguous sections of board.

// 2 painters cannot share a board to paint. That is to say, a board
// cannot be painted partially by one painter, and partially by another.
// A painter will only paint contiguous boards. Which means a
// configuration where painter 1 paints board 1 and 3 but not 2 is
// invalid.
// Return the ans % 10000003

// Input :
// K : Number of painters
// T : Time taken by painter to paint 1 unit of board
// L : A List which will represent length of each board

// Output:
//      return minimum time to paint all boards % 10000003
// Example

// Input : 
//   K : 2
//   T : 5
//   L : [1, 10]
// Output : 50

/**
 * OPTIMAL.
 * Binary search problem
 * 1. we set the min time to start with an arbitrary value as mid value between min and max time
 * 2. check if current min time is possible to allocate painters, if possible, update the final result
 * to be the lesser time required.
 * 3. since current min time is possible, we try to find a smaller time in the smaller range by setting end = mid -1
 * 4. if current min time not possible, the result could be bigger, we try to find a bigger time in the bigger range by
 * setting start = mid + 1
 *
 * Time: O(logn) where n is total time take for all the board to be painted by 1 painter.
 * Space: O(1)
 */
function minPaintTime($arr, $painters, $perLengthTime) {
    if ($painters < 1 || sizeof($arr) < 1) {
        return 0;
    }
    $totalTime = 0;
    for ($i=0; $i < sizeof($arr); $i++) { 
        $totalTime += $arr[$i] * $perLengthTime;
    }
    $start = 0;
    $end = $totalTime;
    $result = PHP_INT_MAX;
    while ($start <= $end) {
        $mid = floor(($start + $end) / 2);
        if (isPossible($arr, $painters, $perLengthTime, $mid)) {
            $result = min($result, $mid);
            $end = $mid - 1;
        } else {
            $start = $mid + 1;
        }
    }
    return $result;
}

/**
 * O(n) where n is size of the array.
 * 1. loop through the array, while maintaining a local max time so far
 * 2. we greedily try to allocate the boards to the same painter
 * 3. if the total time required(local_max) is more than the curr min, we need to
 * allocate the current board to a new painter. ie. incrementing the painter
 * 4. if the painter number required exceeds the give number of painters, this min time
 * is not possible.
 * 5. otherwise, painters can be allocated successfully to achieve min time. return true.
 */
function isPossible($arr, $painters, $perLengthTime, $currMin) {
    $paintersRequired = 1;
    $localMax = 0;

    for ($i=0; $i < sizeof($arr); $i++) { 
        if ($arr[$i] * $perLengthTime > $currMin) {
            return False;
        }
        $localMax += $arr[$i] * $perLengthTime;
        // $paintersRequired++;
        if ($localMax > $currMin) {
            $localMax = $arr[$i] * $perLengthTime;
            $paintersRequired++;
            if ($paintersRequired > $painters) {
                return False;
            }
        }
        
    }
    return True;
}

$arr1 = [1,10];
$arr2 = [ 640, 435, 647, 352, 8, 90, 960, 329, 859 ];
$arr3 = [1000000, 1000000];

echo minPaintTime($arr1, 2, 5) . PHP_EOL;
echo minPaintTime($arr2, 3, 10) . PHP_EOL;
echo minPaintTime($arr3, 1, 1000000) . PHP_EOL;