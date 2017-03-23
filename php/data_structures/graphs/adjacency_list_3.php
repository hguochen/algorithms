<?php

/**
 * Implmenting a graph using adjacency list, but using array instead.
 */

class Graph {
    private $adjList;

    public function __construct() {
        $this->adjList = [];
    }

    public function addEdge($vertice, $neighbours) {
        $this->adjList[$vertice] = $neighbours;
        return;
    }

    public function printGraph() {
        foreach ($this->adjList as $key => $value) {
            echo $key . ": " . "[" . implode(" ", $value) . "]" . PHP_EOL;
        }
    }

    public function bfs($start) {
        $visited = array_fill(0, sizeof($this->adjList), False);
        $visitOrder = [];
        $queue = [$start];

        while (!empty($queue)) {
            $vertice = array_shift($queue);
            $visitOrder[] = $vertice;
            $visited[$vertice] = True;
            for ($i=0; $i < sizeof($this->adjList[$vertice]); $i++) { 
                if (!$visited[$this->adjList[$vertice][$i]] &&
                    !in_array($this->adjList[$vertice][$i], $queue)) {
                        $queue[] = $this->adjList[$vertice][$i];
                }
            }
        }
        return $visitOrder;
    }
}

$graph = new Graph();
$graph->addEdge(0, [1,4]);
$graph->addEdge(1, [0,4,2,3]);
$graph->addEdge(2, [1,3]);
$graph->addEdge(3, [1,4,2]);
$graph->addEdge(4, [3,0,1]);
$graph->printGraph();
print_r($graph->bfs(0));