<?php

// The n-queens puzzle is the problem of placing n queens on an n×n chessboard such that no two queens attack each other.

// Given an integer n, return all distinct solutions to the n-queens puzzle.

// Each solution contains a distinct board configuration of the n-queens’ placement, where 'Q' and '.' both indicate a queen and an empty space respectively.

// For example,
// There exist two distinct solutions to the 4-queens puzzle:

// [
//  [".Q..",  // Solution 1
//   "...Q",
//   "Q...",
//   "..Q."],

//  ["..Q.",  // Solution 2
//   "Q...",
//   "...Q",
//   ".Q.."]
// ]

function nQueens($n) {
    if ($n < 4) {
        return [];
    }
    $result = [];
    $board = generateBoard($n);
    solve($board, $result, 0);
    for ($i=0; $i < sizeof($result); $i++) { 
        printBoard($result[$i]);
        echo "-----" . PHP_EOL;
    }
    echo sizeof($result) . PHP_EOL;
    return;
}

function solve($board, &$result, $queen) {
    if ($queen == sizeof($board)) {
        $result[] = $board;
        return True;
    }
    for ($row=0; $row < sizeof($board); $row++) { 
        if (canPlaceQueen($board, $row, $queen)) {
            $board[$row][$queen] = 'Q';
            solve($board, $result, $queen+1);
            $board[$row][$queen] = '.';
        }
    }
    return False;
}

function canPlaceQueen($board, $row, $col) {
    // check row
    for ($i=0; $i < sizeof($board[$row]); $i++) { 
        if ($board[$row][$i] == 'Q') {
            return False; 
        }
    }
    $i = $row;
    $j = $col;
    // check diagonal up
    while ($i >= 0 && $j >= 0) {
        if ($board[$i][$j] == 'Q') {
            return False;
        }
        $i--;
        $j--;
    }
    // check diagonal below
    $i = $row;
    $j = $col;
    while ($i < sizeof($board) && $j >= 0) {
        if ($board[$i][$j] == 'Q') {
            return False;
        }
        $i++;
        $j--;
    }
    return True;
}
/**
 * Takes in an integer and generate a n by n size chess board.
 *
 */
function generateBoard($n) {
    $result = array_fill(0, $n, array_fill(0, $n, '.'));
    return $result;
}

function printBoard($board) {
    for ($i=0; $i < sizeof($board); $i++) { 
        echo implode("", $board[$i]);
        echo PHP_EOL;
    }
}

nQueens(8);