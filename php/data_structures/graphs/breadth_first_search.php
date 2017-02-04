<?php

include "adjacency_list.php";

function breadthFirstSearch(Graph $graph, $startIndex, $callback) {
    // mark every vertex as undiscovered and unprocessed and parent to null
    // mark startindex as discovered.
    // put startindex node into queue.
    // while queue is not empty
    //     set dequeue element variable
    //     process dequeue element
    //     get edges of dequeued element
    //     while loop traverse through the edges
    //          check process edge status
    //          check discovered edge status
    //          move to next edge
    //     mark dequeued element as processed
    $discovered = array_fill(0, $graph->getVerticeCount(), False);
    $processed = array_fill(0, $graph->getVerticeCount(), False);
    $parent = array_fill(0, $graph->getVerticeCount(), NULL);

    $discovered[$startIndex] = True;
    $queue = [$startIndex];

    while (!empty($queue)) {
        $index = array_shift($queue);
        $callback($index);
        $curr = $graph->getEdges()[$index];
        while (!empty($curr)) {
            if (!$discovered[$curr->data]) {
                $discovered[$curr->data] = True;
                $parent[$curr->data] = $index;
                $queue[] = $curr->data;
            }
            $curr = $curr->next;
        }
        $processed[$index] = True;
    }
    print_r($discovered);
    print_r($processed);
    print_r($parent);
}

function printData($data) {
    echo "{$data} ";
}

$graph = new Graph(5);

$edgeList0 = new EdgeList(1);
$edgeList0->insert(4);

$edgeList1 = new EdgeList(0);
$edgeList1->insert(4);
$edgeList1->insert(2);
$edgeList1->insert(3);

$edgeList2 = new EdgeList(1);
$edgeList2->insert(3);

$edgeList3 = new EdgeList(1);
$edgeList3->insert(4);
$edgeList3->insert(2);

$edgeList4 = new EdgeList(3);
$edgeList4->insert(0);
$edgeList4->insert(1);

$graph->insertEdge($edgeList0);
$graph->insertEdge($edgeList1);
$graph->insertEdge($edgeList2);
$graph->insertEdge($edgeList3);
$graph->insertEdge($edgeList4);
$graph->printGraph();

breadthFirstSearch($graph, 0, 'printData');
echo PHP_EOL;
