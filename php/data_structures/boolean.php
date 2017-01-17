<?php

var_dump((bool) "");        // false
var_dump((bool) 1);         // true
var_dump((bool) -2);        // true
var_dump((bool) "foo");     // true
var_dump((bool) 2.3e5);     // true
var_dump((bool) array(12)); // true
var_dump((bool) array());   // false
var_dump((bool) "false");   // true