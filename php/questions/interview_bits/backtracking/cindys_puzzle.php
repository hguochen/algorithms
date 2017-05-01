<?php

// You have some number n of black marbles and the same number of white marbles,
// and you have a playing board which consists simply of a line of 2n+1 spaces
// to put the marbles in. Start with the black marbles all at one end (say, the
// left), the white marbles all at the other end, and a free space in between.

// The goal is to reverse the positions of the marbles

// The black marbles can only move to the right, and the white marbles can only
// move to the left (no backing up). At each move, a marble can either:

// Move one space ahead, if that space is clear, or
// Jump ahead over exactly one marble of the opposite color, if the space just
// beyond that marble is clear.

function solvable($table) {
    if (puzzleSolved($table, $table)) {
        printBoard($table);
        return True;
    }
    for ($i=0; $i < sizeof($table); $i++) {

        if (canMove($table, $i)) {
            $newTable = makeMove($table, $i);
            if (solvable($newTable)) {
                // printBoard($newTable);
                return True;
            }
        }
    }
    return False;
}

function puzzleSolved($table) {
    $table1 = [0, 0, 0, NULL, 1, 1, 1];
    if ($table == $table1) {
        return True;
    }
    return False;
}

function canMove($table, $pos) {
    if ($table[$pos] == NULL) {
        return False;
    } elseif ($table[$pos] == 1) {
        if ($pos+1 < sizeof($table) && $table[$pos+1] == "_") {
            return True;
        } elseif ($pos+2 < sizeof($table) && $table[$pos+2] == "_") {
            return True;
        }
        return False;
    } else {
        if ($pos-1 >= 0 && $table[$pos-1] == "_") {
            return True;
        } elseif ($pos-2 < sizeof($table) && $table[$pos-2] == "_") {
            return True;
        }
        return False;
    }
}

function makeMove($table, $pos) {
    if ($table[$pos] == 1) {
        if ($pos+1 < sizeof($table) && $table[$pos+1] == "_") {
            swap($table[$pos], $table[$pos+1]);
        } elseif ($pos+2 < sizeof($table) && $table[$pos+2] == "_") {
            swap($table[$pos], $table[$pos+2]);
        }
    } elseif ($table[$pos] == 0) {
        if ($pos-1 >= 0 && $table[$pos-1] == "_") {
            swap($table[$pos], $table[$pos-1]);
        } elseif ($pos-2 >=0 && $table[$pos-2] == "_") {
            swap($table[$pos], $table[$pos-2]);
        }
    }
    return $table;
}

function printBoard($table) {
    for ($i=0; $i < sizeof($table); $i++) { 
        echo $table[$i] . " ";
    }
    echo PHP_EOL;
}

function swap(&$v1, &$v2) {
    $temp = $v1;
    $v1 = $v2;
    $v2 = $temp;
}

$table1 = [1, 1, 1, "_", 0, 0, 0];

solvable($table1);
