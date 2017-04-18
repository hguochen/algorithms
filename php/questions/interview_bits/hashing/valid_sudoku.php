<?php

// Determine if a Sudoku is valid, according to: http://sudoku.com.au/TheRules.aspx

// The Sudoku board could be partially filled, where empty cells are filled with
// the character ‘.’.

// The input corresponding to the above configuration :

// ["53..7....", "6..195...", ".98....6.", "8...6...3", "4..8.3..1", "7...2...6", ".6....28.", "...419..5", "....8..79"]
// A partially filled sudoku which is valid.

//  Note:
// A valid Sudoku board (partially filled) is not necessarily solvable. Only the
// filled cells need to be validated.
// Return 0 / 1 ( 0 for false, 1 for true ) for this problem

/**
 * Time: O(n^2) where n is the size of the board
 * Space: O(n^2)
 *
 */
function validSudoKu($board) {
    if (empty($board)) {
        return 0;
    }
    $rowTable = array_fill(0, 9, []);
    $colTable = array_fill(0, 9, []);
    $boxTable = array_fill(0, 9, []);

    for ($i=0; $i < sizeof($board); $i++) { 
        for ($j=0; $j < strlen($board[$i]); $j++) { 
            $char = $board[$i][$j];
            if (is_numeric($char)) {
                //update row table
                if (!isset($rowTable[$i][$char])) {
                    $rowTable[$i][$char] = 1;
                } else {
                    return 0;
                }
                
                //update col table
                if (!isset($colTable[$j][$char])) {
                    $colTable[$j][$char] = 1;
                } else {
                    return 0;
                }
                //update box table
                if ($i <= 2 && $j <= 2) {
                    // box 0
                    if (!isset($boxTable[0][$char])) {
                        $boxTable[0][$char] = 1;
                    } else {
                        return 0;
                    }
                } elseif ($i <= 2 && $j >= 3 && $j <= 5) {
                    // box 1
                    if (!isset($boxTable[1][$char])) {
                        $boxTable[1][$char] = 1;
                    } else {
                        return 0;
                    }
                } elseif ($i <= 2 && $j >= 6 && $j <= 8) {
                    // box 2
                    if (!isset($boxTable[2][$char])) {
                        $boxTable[2][$char] = 1;
                    } else {
                        return 0;
                    }
                } elseif ($i >= 3 && $i <= 5 && $j <= 2) {
                    // box 3
                    if (!isset($boxTable[3][$char])) {
                        $boxTable[3][$char] = 1;
                    } else {
                        return 0;
                    }
                } elseif ($i >= 3 && $i <= 5 && $j >= 3 && $j <= 5) {
                    // box 4
                    if (!isset($boxTable[4][$char])) {
                        $boxTable[4][$char] = 1;
                    } else {
                        return 0;
                    }
                } elseif ($i >= 3 && $i <= 5 && $j >= 6 && $j <= 8) {
                    // box 5
                    if (!isset($boxTable[5][$char])) {
                        $boxTable[5][$char] = 1;
                    } else {
                        return 0;
                    }
                } elseif ($i >= 6 && $i <= 8 && $j <= 2) {
                    // box 6
                    if (!isset($boxTable[6][$char])) {
                        $boxTable[6][$char] = 1;
                    } else {
                        return 0;
                    }
                } elseif ($i >= 6 && $i <= 8 && $j >= 3 && $j <= 5) {
                    // box 7
                    if (!isset($boxTable[7][$char])) {
                        $boxTable[7][$char] = 1;
                    } else {
                        return 0;
                    }
                } else {
                    // box 8
                    if (!isset($boxTable[8][$char])) {
                        $boxTable[8][$char] = 1;
                    } else {
                        return 0;
                    }
                }
            }
        }
    }
    return 1;
}