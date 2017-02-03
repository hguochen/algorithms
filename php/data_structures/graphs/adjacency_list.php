<?php

class EdgeNode {
    public $data;
    public $weight;
    public $next;

    public function __construct($data, $weight=0, $next=NULL) {
        $this->data = $data;
        $this->weight = $weight;
        $this->next = $next;
    }
}

class EdgeList {
    private $head;

    public function __construct($data, $weight=0, $next=NULL) {
        $this->head = new EdgeNode($data, $weight, $next);
    }

    /**
     * Insert to the end of the node.
     * @return [type] [description]
     */
    public function insert($data, $weight=0, $next=NULL) {
        $newEdgeNode = new EdgeNode($data, $weight, $next);
        if (empty($this->head)) {
            $this->head = $newEdgeNode;
        }
        $curr = $this->head;
        while (!empty($curr->next)) {
            $curr = $curr->next;
        }
        $curr->next = $newEdgeNode;
        return;
    }

    public function getHead() {
        return $this->head;
    }

    public function printList() {
        if (empty($this->head)) {
            return;
        }
        $curr = $this->head;
        while (!empty($curr)) {
            echo "{$curr->data} ";
            $curr = $curr->next;
        }
        echo PHP_EOL;
    } 
}

class Graph {
    private $edges; // adjacency info. array of head pointers to adj lists
    private $degrees; // outdegree of each vertex
    private $nVertices; // number of vertices
    private $nEdges; // number of edges
    private $directed; // is the graph directed?

    public function __construct($nVertices = 0, $nEdges = 0, $directed = false) {
        $this->nVertices = $nVertices;
        $this->edges = array_fill(0, $nVertices, NULL);
        $this->degrees = array_fill(0, $nVertices, 0);
        $this->nEdges = $nEdges;
        $this->directed = $directed;
    }

    // public function insert
    public function getEdges() {
        return $this->edges;
    }

    public function getDegrees() {
        return $this->degrees;
    }

    public function printGraph() {
        echo "===Graph Details===" . PHP_EOL;
        echo "==Edges==" . PHP_EOL;
        for ($i=0; $i<sizeof($this->edges); $i++) {
            $curr = $this->edges[$i];
            echo "edge {$i} with degree: ". $this->degrees[$i] . PHP_EOL;
            while (!empty($curr)) {
                echo "{$curr->data} ";
                $curr = $curr->next;
            }
            echo PHP_EOL;
        }
        echo "Vertice count: {$this->nVertices}" . PHP_EOL;
        echo "Edge count: {$this->nEdges}" . PHP_EOL;
        if ($this->directed) {
            echo "Directed: TRUE" . PHP_EOL;
        } else {
            echo "Directed: FALSE" . PHP_EOL;
        }
    }
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

$graph->printGraph();
