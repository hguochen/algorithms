<?php

class SetUnion {
    public $parent;
    public $elementSize;
    public $unionSize;

    public function __construct($unionSize) {
        $this->unionSize = $unionSize;
        $this->parent = [];
        $this->elementSize = [];
        for ($i=0; $i < $unionSize; $i++) { 
            $this->parent[] = $i;
            $this->elementSize[] = 1;
        }
    }
}
