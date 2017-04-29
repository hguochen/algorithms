<?php

// Given a string S and a string T, find the minimum window in S which will
// contain all the characters in T in linear time complexity.
// Note that when the count of a character C in T is N, then the count of C in
// minimum window in S should be at least N.

// Example :

// S = "ADOBECODEBANC"
// T = "ABC"
// Minimum window is "BANC"

//  Note:
// If there is no such window in S that covers all characters in T, return the
// empty string ''.
// If there are multiple such windows, return the first occurring minimum window
// ( with minimum start index ).

function windowString($str1, $str2) {
    if (empty($str1) || empty($str2)) {
        return "";
    }
    $expected = [];
    for ($i=0; $i < strlen($str2); $i++) { 
        if (!isset($expected[$str2[$i]])) {
            $expected[$str2[$i]] = 1;
        } else {
            $expected[$str2[$i]]++;
        }
    }
    $actual = [];
    list($left, $right) = [0, 0];
    $result = []; // start and end index of the result string.
    while ($left < strlen($str1) && $right < strlen($str1)) {
        // all chars in str2 are in current left right boundaries in str1
        if (sizeof($expected) == sizeof($actual)) {
            // move ahead left pointer as long as char is not in expected table
            while (!isset($expected[$str1[$left]])) {
                $left++;
            }
            // left is now pointing to the first char that's also in expected
            if (empty($result) || $result[1] - $result[0] > $right - $left) {
                $result = [$left, $right];
            }
            // unset the char in actual table.
            if ($actual[$str1[$left]] == 1) {
                unset($actual[$str1[$left]]);
            } else {
                $actual[$str1[$left]]--;
            }
            $left++;
        } else { // not all chars are in yet
            if (isset($expected[$str1[$right]])) {
                if (!isset($actual[$str1[$right]])) {
                    $actual[$str1[$right]] = 1;
                } else {
                    $actual[$str1[$right]]++;
                }
            }
            if ($right < strlen($str1)-1) {
                $right++;
            } else {
                $left++;
            }
        }
        print_r($result);
    }
    return substr($str1, $result[0], $result[1] - $result[0]+1);
}

$str1 = "ADOBECODEBANC";
$str2 = "ABC";

$str3 = "0mJdGXwLm9AOZ5xA8u92KDYqGJroQ537hoRXjQoUCMOpDYwxoNjexJGWQJAIxSFF3ZbIe27oFxUTJxtv8mORwpuRZn30MDj3kXRW2Ix3lslj7kwmGZPXAKhBW4q5T2BzsqbL0ZETFqRdxVm8GCGfqshvpWzsRvprUcF9vw3VlftqTRzKRzr4zYB2P6C7lg3I7EhGMPukUj8XGGZTXqPqnCqes";
$str4 = "rsm2ty04PYPEOPYO5";

$str5 = "xiEjBOGeHIMIlslpQIZ6jERaAVoHUc9Hrjlv7pQpUSY8oHqXoQYWWll8Pumov89wXDe0Qx6bEjsNJQAQ0A6K21Z0BrmM96FWEdRG69M9CYtdBOrDjzVGPf83UdP3kc4gK0uHVKcPN4HPdccm9Qd2VfmmOwYCYeva6BSG6NGqTt1aQw9BbkNsgAjvYzkVJPOYCnz7U4hBeGpcJkrnlTgNIGnluj6L6zPqKo5Ui75tC0jMojhEAlyFqDs7WMCG3dmSyVoan5tXI5uq1IxhAYZvRQVHtuHae0xxwCbRh6S7fCLKfXeSFITfKHnLdT65K36vGC7qOEyyT0Sm3Gwl2iXYSN2ELIoITfGW888GXaUNebAr3fnkuR6VwjcsPTldQSiohMkkps0MH1cBedtaKNoFm5HbH15kKok6aYEVsb6wOH2w096OwEyvtDBTQwoLN87JriLwgCBBavbOAiLwkGGySk8nO8dLHuUhk9q7f0rIjXCsQeAZ1dfFHvVLupPYekXzxtWHd84dARvv4Z5L1Z6j8ur2IXWWbum8lCi7aErEcq41WTo8dRlRykyLRSQxVH70rUTz81oJS3OuZwpI1ifBAmNXoTfznG2MXkLtFu4SMYC0bPHNctW7g5kZRwjSBKnGihTY6BQYItRwLUINApd1qZ8W4yVG9tnjx4WyKcDhK7Ieih7yNl68Qb4nXoQl079Vza3SZoKeWphKef1PedfQ6Hw2rv3DpfmtSkulxpSkd9ee8uTyTvyFlh9G1Xh8tNF8viKgsiuCZgLKva32fNfkvW7TJC654Wmz7tPMIske3RXgBdpPJd5BPpMpPGymdfIw53hnYBNg8NdWAImY3otYHjbl1rqiNQSHVPMbDDvDpwy01sKpEkcZ7R4SLCazPClvrx5oDyYolubdYKcvqtlcyks3UWm2z7kh4SHeiCPKerh83bX0m5xevbTqM2cXC9WxJLrS8q7XF1nh";
$str6 = "dO4BRDaT1wd0YBhH88Afu7CI4fwAyXM8pGoGNsO1n8MFMRB7qugS9EPhCauVzj7h";

echo windowString($str1, $str2) . PHP_EOL;
echo windowString($str3, $str4) . PHP_EOL;
echo windowString($str5, $str6) . PHP_EOL;
