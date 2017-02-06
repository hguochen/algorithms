<?php

include "adjacency_list_2.php";
include "set_union.php";

function kruskalMST(Graph $graph) {
    // put all edges in a queue ordered by weight
    $minHeap = new SplMinHeap();
    $setUnion = new SetUnion($graph->getVerticeCount());
    $result = [];

    for ($i=0; $i < $graph->getVerticeCount(); $i++) {
        $curr = $graph->getEdges()[$i];
        while (!empty($curr)) {
            $minHeap->insert([$curr->weight, $i, $curr->data]);
            $curr = $curr->next;
        }
    }
    // loop through all edges
    while (!$minHeap->isEmpty()) {
        // extract next min weight edge
        $value = $minHeap->extract();
        // if 2 vertices of this edge is not connected, connect them and store in result
        if (!$setUnion->sameComponent($value[1], $value[2])) {
            $added = $setUnion->unionSets($value[1], $value[2]);
            // add to result if union operation is performed
            if ($added) {
                $result[] = [$value[1], $value[2], $value[0]];
            }
        }
    }

    return $result;
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

$result = kruskalMST($graph);
foreach ($result as $key => $value) {
    echo implode(" ", $value) . PHP_EOL;
}