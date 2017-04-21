<?php

// implement a funciton spellchecker($str)
// 0 < sizeof str < PHP_INT_MAX
// IP: str (misspelled word)
// OP: str

function spellCheck($table, $chars, $str) {
    // lookup the str
    // if str is in table, return str
    // else
    //  indicate a size of the char to change
    //  changesize = 1
    //      run a for loop
    //          
    if (empty($str)) {
        return "";
    } elseif (isset($table[$str])) {
        return $str;
    }
    $localChars = $chars;
    $changeSize = 1;
    $changeIndex = 0;
    while ($changeIndex < strlen($str)) {
        // find index of current char and remove in localChars
        removeCurrentChars($str[$changeIndex], $localChars);
        for ($i=0; $i < localChars; $i++) { 
            $sub = substr_replace($str, $localChars[$i], $changeIndex, 1);
            if (isWord($sub)) {
                return $sub;
            }
        }
        $changeIndex++;
        $changeSize++;
        if ($changeSize >= sizeof($str)) {
            break;
        }
    }
    return $str;
} 

function isWord($chars, $table) {
    if (isset($table[$chars])) {
        return True;
    }
    return False;
}

function removeCurrentChars($char, &$localChars) {
    // remove this char in localChars
    return;
}

function preProcess($texts) {
    $words = explode(" ", $texts);
    $table = [];
    for ($i=0; $i < sizeof($words); $i++) { 
        if (!isset($table[$words[$i]])) {
            $table[$words[$i]] = 1;
        }
    }
    return $table;
}

function main($file) {
    $texts = fgets($file);
    $table = preProcess($texts);

    spellCheck($table, $str);
}

$str1 = "apple";
$str2 = "abple";
$chars = ["a", "b", "p", "l", "e"]; /// all 26 chars