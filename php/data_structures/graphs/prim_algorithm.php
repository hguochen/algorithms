<?php

include "adjacency_list_2.php";

function primMST(Graph $graph, $startIndex) {
    // init mst bool array
    // init keys array to store weight values of all vertices
    // init parents array to store indexes of parent nodes mst
    $mst = array_fill(0, $graph->getVerticeCount(), False);
    $keys = array_fill(0, $graph->getVerticeCount(), PHP_INT_MAX);
    $parents = array_fill(0, $graph->getVerticeCount(), NULL);
    
    // set startindex key to 0
    $keys[$startIndex] = 0;
    $index = $startIndex;
    // while there are vertices not visited
    while (in_array(False, $mst)) {
        // set this vertice as visited
        $mst[$index] = True;
        // update adjacent edge vertices of this vertex
        $curr = $graph->getEdges()[$index];
        while (!empty($curr)) {
            // if current vertex is not visited, and found weight is lesser than key weight
            //     set found weight to key weight
            //     set current vertex parent to index vertex above
            if (!$mst[$curr->data] && $keys[$curr->data] > $curr->weight) {
                $keys[$curr->data] = $curr->weight;
                $parents[$curr->data] = $index;
            }
            // move to next edge
            $curr = $curr->next;
        }
        // find the minimum weight and set it's index
        $index = getMinWeightIndex($graph, $mst, $keys);
    }
    return $parents;
}

function getMinWeightIndex(Graph $graph, $mst, $keys) {
    $minDist = PHP_INT_MAX;
    $index = -1;
    for ($i=0; $i < $graph->getVerticeCount(); $i++) { 
        if(!$mst[$i] && $minDist > $keys[$i]) {
            $minDist = $keys[$i];
            $index = $i;
        }
    }
    return $index;
}

$graph = new Graph(9, 0, False);
$graph->insertEdge(0, 1, 4);
$graph->insertEdge(0, 7, 8);

$graph->insertEdge(1, 2, 8);
$graph->insertEdge(1, 7, 11);

$graph->insertEdge(2, 1, 8);
$graph->insertEdge(2, 3, 7);
$graph->insertEdge(2, 5, 4);
$graph->insertEdge(2, 8, 2);

$graph->insertEdge(3, 2, 7);
$graph->insertEdge(3, 4, 9);
$graph->insertEdge(3, 5, 14);

$graph->insertEdge(4, 3, 9);
$graph->insertEdge(4, 5, 10);

$graph->insertEdge(5, 2, 4);
$graph->insertEdge(5, 3, 14);
$graph->insertEdge(5, 4, 10);
$graph->insertEdge(5, 6, 2);

$graph->insertEdge(6, 5, 2);
$graph->insertEdge(6, 7, 1);
$graph->insertEdge(6, 8, 6);

$graph->insertEdge(7, 0, 8);
$graph->insertEdge(7, 1, 11);
$graph->insertEdge(7, 8, 7);
$graph->insertEdge(7, 6, 1);

$graph->insertEdge(8, 2, 2);
$graph->insertEdge(8, 6, 6);
$graph->insertEdge(8, 7, 7);
$graph->printGraph();

echo implode(" ", primMST($graph, 0)) . PHP_EOL;
