<?php

/**
 * Implementing a min heap with array.
 */

class MaxHeap {
    private $heap;

    public function __construct($heap=array()) {
        $this->heap = $heap;
    }

    public function insert($data) {
        $this->heap[] = $data;
    }

    public function delete() {
        // check empty heap
        if (empty($this->heap)) {
            return false;
        }
        // swap first and last index
        $this->swap($this->heap[0], $this->heap[sizeof($this->heap)-1]);

        // delete last index element
        $largest = array_pop($this->heap);
        // siftdown the new first index
        if (!empty($this->heap)) {
            $this->siftDown(0);
        }
        return $result;
    }

    private function swap(&$value1, &$value2) {
        $temp = $value1;
        $value1 = $value2;
        $value2 = $temp;
    }

    /**
     * Sift down value at given index repeatedly so the max heap structure is maintained.
     */
    private function siftDown($siftIndex) {
        return NULL;
    }

    /**
     * Return the largest value in the heap.
     * @return [type] [description]
     */
    public function largest() {
        if (empty($this->heap)) {
            return;
        }
        return $this->heap[0];
    }

    public function getHeap() {
        return $this->heap;
    }

    private function getParentIndex($index) {
        if ($index == 0) {
            return NULL;
        }
        return floor(($index-1) / 2);
    }

    private function getLeftChildIndex($index) {
        return $index*2 + 1;
    }

    private function getRightChildIndex($index) {
        return $index*2 + 2;
    }
}

$maxHeap = new MaxHeap();
$maxHeap->insert(104);
$maxHeap->insert(71);
$maxHeap->insert(24);
$maxHeap->insert(66);
$maxHeap->insert(27);
$maxHeap->insert(23);
$maxHeap->insert(8);
$maxHeap->insert(5);
$maxHeap->insert(32);
$maxHeap->insert(25);
$maxHeap->insert(18);
$maxHeap->insert(22);
print_r($maxHeap->getHeap());
echo $maxHeap->delete();
print_r($maxHeap->getHeap());
