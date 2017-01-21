<?php

/**
 * Implement a queue data structure with arrays.
 */
class Queue {
    private $arr;

    public function __construct() {
        $this->arr = [];
    }

    public function enqueue($data) {
        $this->arr[] = $data;
    }

    public function dequeue() {
        if ($this->isEmpty()) {
            echo "Queue is empty." . PHP_EOL;
            return;
        }
        return array_shift($this->arr);
    }

    public function isEmpty() {
        return empty($this->arr);
    }

    public function printQueue() {
        echo implode(" ", $this->arr) . PHP_EOL;
    }
}

$queue = new Queue();
$queue->enqueue(1);
$queue->enqueue(2);
$queue->enqueue(3);
$queue->enqueue(4);
$queue->enqueue(5);

$queue->dequeue();
$queue->printQueue();
$queue->dequeue();
$queue->printQueue();
$queue->dequeue();
$queue->printQueue();
$queue->dequeue();
$queue->printQueue();
$queue->dequeue();
$queue->printQueue();
$queue->dequeue();