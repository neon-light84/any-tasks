<?php

interface InterfaceCar {
     function __construct(string $category);
     function getCategory(): string;
}

interface InterfaceParkingFloor {
    function __construct(array $availableCarCategory, int $placeCount);
    function takeCar(Car $car): bool;
}

interface InterfaceParking {
    public function __construct();
    public function addFloor(ParkingFloor $floor);
    public function takeCar(Car $car): bool;

    }