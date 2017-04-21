<?php
// http://yucoding.blogspot.com/2013/12/leetcode-question-max-points-on-line.html
// Given n points on a 2D plane, find the maximum number of points that lie on
// the same straight line.

// Sample Input :

// (1, 1)
// (2, 2)
// Sample Output :

// 2
// You will be give 2 arrays X and Y. Each point is represented by (X[i], Y[i])
// 
// Corner cases :
// 1) Have you handled overlapping points ? 
// for overlapping points, gradient is 0, so handle it like gradient is 0
// 2) Have you handled negative points for the same slope ? Like (0,0), (1,1) and (-1, -1)
// for 2 points, the gradient must be the same no matter which sequence of x, y u are using to calculate. use abs value
// 3) Did you make sure that there are no divisions by 0 ? Like (1, 0), (1,4), (1, -1) 
// if x values comes to 0. gradient is undefined, mark a undefined variable in table
// 4) How do you handle when one of the differences in x and y is 0, and the other difference is negative / positive ? Like (4, -4), (8, -4), (-4, -4)
// y gradient results in 0, gradient is 0 increment 0th key

/**
 * Grad = (y2 - y1) / (x2 - x1)
 * Assum X and Y array are equal size
 * For each pair of coordinates, calculate the gradient and put into hashtable.
 * return the maximum value in the hash table.
 * +
 * Corner cases:
 * 1. duplicate points
 * 2. points make a vertical line
 * 3. points make a horizontal line
 *
 * Note: gradients must be stored in their floating point values, not truncated
 * 
 * Time: O(n^2) where n is the size of X. assume X and Y have same inputs
 * Space: O(n)
 */
function points($X, $Y) {
    if (sizeof($X) <= 2 || sizeof($Y) <= 2) {
        return sizeof($X);
    }
    $result = 0;
    $i = 0;
    while ($i < sizeof($X) && $i < sizeof($Y)) {
        $table = [];
        $dup = 1;
        $j = $i + 1;
        while ($j < sizeof($X) && $j < sizeof($Y)) {
            if ($X[$i] == $X[$j] && $Y[$i] == $Y[$j]) {
                $dup++;
            } elseif ($X[$i] == $X[$j]) { # vertical line, grad undefined
                if (!isset($table["vert"])) {
                    $table["vert"] = 1;
                } else {
                    $table["vert"]++;
                }
            } elseif ($Y[$i] == $Y[$j]) { # horizontal line, grad 0
                if (!isset($table["horz"])) {
                    $table["horz"] = 1;
                } else {
                    $table["horz"]++;
                }
            } else {
                $grad = 1.0 * ($Y[$j] - $Y[$i]) / ($X[$j] - $X[$i]);
                if (!isset($table[$grad])) {
                    $table[$grad] = 1;
                } else {
                    $table[$grad]++;
                }
            }
            $j++;
        }
        if (!empty($table)) {
            $localMax = max($table);
            if ($localMax + $dup > $result) {
                $result = $localMax + $dup;
            }
        } else { # all points are duplicates
            if ($dup > $result) {
                $result = $dup;
            }
        }
        $i++;
    }
    return $result;
}

$X1 = [1, 2];
$Y1 = [1, 2];

$X2 = [0, 1, -1];
$Y2 = [0, 1, -1];

$X3 = [1,1,1,1,1];
$Y3 = [1,1,1,1,1];

$X4 = [-6, 5, -18, 2, 5, -2];
$Y4 = [-17, -16, -17, -4, -13, 20];

echo points($X1, $Y1) . PHP_EOL;
echo points($X2, $Y2) . PHP_EOL;
echo points($X3, $Y3) . PHP_EOL;
echo points($X4, $Y4) . PHP_EOL;
