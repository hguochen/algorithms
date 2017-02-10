<?php

/**
 * Given a sequence number, compute the fibonacci number.
 * Basic recursive fibonacci sequence.
 */
function fibonacci($n) {
    if ($n <= 2) {
        return 1;
    }
    return fibonacci($n-1) + fibonacci($n-2);
}

/**
 * Iterative fibonacci number generation.
 */
function fibonacciIterative($n) {
    if ($n <= 2) {
        return 1;
    }
    $prev = 1;
    $curr = 1;
    for ($i=3; $i <= $n; $i++) { 
        $temp = $curr;
        $curr += $prev;
        $prev = $temp;
    }
    return $curr;
}

echo fibonacci(1) . PHP_EOL;
echo fibonacci(2) . PHP_EOL;
echo fibonacci(3) . PHP_EOL;
echo fibonacci(4) . PHP_EOL;
echo fibonacci(5) . PHP_EOL;
echo fibonacci(6) . PHP_EOL;
echo fibonacci(7) . PHP_EOL;
echo fibonacci(8) . PHP_EOL;
echo fibonacci(9) . PHP_EOL;

echo fibonacciIterative(1) . PHP_EOL;
echo fibonacciIterative(2) . PHP_EOL;
echo fibonacciIterative(3) . PHP_EOL;
echo fibonacciIterative(4) . PHP_EOL;
echo fibonacciIterative(5) . PHP_EOL;
echo fibonacciIterative(6) . PHP_EOL;
echo fibonacciIterative(7) . PHP_EOL;
echo fibonacciIterative(8) . PHP_EOL;
echo fibonacciIterative(9) . PHP_EOL;

