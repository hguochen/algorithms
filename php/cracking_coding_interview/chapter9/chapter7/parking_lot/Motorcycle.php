<?php

include_once("abstract.Vehicle.php");
include_once("VehicleType.php");

class Motorcycle extends Vehicle {

    public function __construct($model, $make) {
        $this->model = $model;
        $this->make = $make;
        $this->type = VehicleType::MOTORCYCLE;
    }
}