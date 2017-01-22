<?php

/**
 * Implementation of a dictionary
 */

class Dictionary {
    private $container;

    public function __construct($dict=array()) {
        $this->container = $dict;
    }

    public function insert($key, $value) {
        $this->container[$key] = $value;
    }

    public function delete($key) {
        if (isset($this->container[$key])) {
            unset($this->container[$key]);
        }
    }

    public function printDictionary() {
        print_r($this->container);
    }

    public function getDict() {
        return $this->container;
    }
}

$dict = new Dictionary();
$dict->insert('gfdsg', 'diamond');
$dict->insert('wtf', 'watermelon');
$dict->insert('a', 'apple');
$dict->insert('b', 'banana');
$dict->insert('c', 'carrot');
$dict->printDictionary();
$dict->delete('c');
$dict->printDictionary();
asort($dict->getDict());
$dict->printDictionary();