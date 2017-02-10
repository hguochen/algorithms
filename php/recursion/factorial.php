<?php

function factorial($n) {
    if ($n == 0) {
        return 1;
    }
    return factorial($n-1) * $n;
}

echo factorial(0) . PHP_EOL;
echo factorial(1) . PHP_EOL; // 1
echo factorial(2) . PHP_EOL; // 2
echo factorial(3) . PHP_EOL; // 6
echo factorial(4) . PHP_EOL; // 24
echo factorial(5) . PHP_EOL; // 120