<?php
// # Write a function:
// #
// #   random_walk(
// #     trans_probs, # a list of transition probabilities between each state in a directed graph (see example below)
// #     start_state, # the state to start the walk from
// #     num_steps,   # the number of steps in the random walk to simulate
// #   )
// #
// # that returns a map from states to the number of times that state was visited

// # Example:

// trans_probs = [
//   ("a", "a", 0.9),  # a -> a with prob 0.9
//   ("a", "b", 0.05), # a -> b with prob 0.05
//   ("a", "c", 0.05), # a -> c with prob 0.05
//   ("b", "b", 0.85), # etc.
//   ("b", "a", 0.10),
//   ("b", "c", 0.05),
//   ("c", "a", 0.50),
//   ("c", "b", 0.25),
//   ("c", "c", 0.25),
// ]

// random_walk(trans_probs, "a", 0) == {"a":1}        # with probability 1
// random_walk(trans_probs, "a", 1) == {"a":2}        # with probability 0.9
// random_walk(trans_probs, "a", 1) == {"a":1, "b":1} # with probability 0.05
// random_walk(trans_probs, "a", 1) == {"a":1, "c":1} # with probability 0.05
// random_walk(trans_probs, "a", 2) == {"a":3}        # with probability 0.81
// # etc.

function randomWalk($transProbs, $startState, $steps) {
    if (empty($transProbs) || $steps == 0) {
        return [$startState => $steps+1];
    }
    $curr = $startState;
    $res = [];
    while ($steps > 0) {
        $value = rand(0, 1);
        // get current state probabilities. list of percentile probabilities
        $result = getStateProbabilities($transProbs, $curr); // O(n)
        
        foreach ($result as $key => $prob) {
            $value -= $prob;
            if ($value < 0) {
                if (!isset($res[$key])) {
                    $res[$key] = 1;
                } else {
                    $res[$key]++;
                }
                $curr = $key;
                break;
            }
        }
        $steps--;
    }
    return $res;
}

function getStateProbabilities($transProbs, $curr) {
    $result = [];
    for ($i=0; $i < sizeof($transProbs); $i++) { 
        if ($transProbs[$i][0] == $curr) {
            if ($transProbs[$i][1] == "a") {
                $result["a"] = $transProbs[$i][2];
            } elseif ($transProbs[$i][1] == "b") {
                $result["b"] = $transProbs[$i][2];
            } else {
                $result["c"] = $transProbs[$i][2];
            }
            $result[$transProbs[$i][1]] = $transProbs[$i][2];
        }
    }

    return $result; // [a=> 0.9, b=>0.05, c=>0.05]
}

function assertEqual($a, $b) {
    return $a == $b;
}

$transProbs = [
  ["a", "a", 0.9],  # a -> a with prob 0.9
  ["a", "b", 0.05], # a -> b with prob 0.05
  ["a", "c", 0.05], # a -> c with prob 0.05
  ["b", "b", 0.85], # etc.
  ["b", "a", 0.10],
  ["b", "c", 0.05],
  ["c", "a", 0.50],
  ["c", "b", 0.25],
  ["c", "c", 0.25],
];

// echo assertEqual(getStateProbabilities($transProbs, "a"), ["a"=> 0.9, "b"=>0.05, "c"=> 0.05]) . PHP_EOL;
// echo assertEqual(getStateProbabilities($transProbs, "b"), ["a"=> 0.1, "b"=>0.85, "c"=> 0.05]) . PHP_EOL;
// echo assertEqual(getStateProbabilities($transProbs, "c"), ["a"=> 0.5, "b"=>0.25, "c"=> 0.25]) . PHP_EOL;

print_r(randomWalk($transProbs, "a", 0));
print_r(randomWalk($transProbs, "a", 1));
print_r(randomWalk($transProbs, "a", 2));
