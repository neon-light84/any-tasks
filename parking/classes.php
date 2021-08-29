<?php
class Car implements InterfaceCar {
    private string $category;

    public function __construct(string $category) {
        if (!HelperValidate::CarCategoryOne($category)) throw new Exception('Не допустимая категория автомобиля');
        $this->category = $category;
    }

    public function getCategory(): string {
        return $this->category;
    }

}

class ParkingFloor implements InterfaceParkingFloor {
    private array $availableCarCategory;
    private int $placeCount;
    private int $placeTaken;
    public function __construct(array $availableCarCategory, int $placeCount) {
        if (!HelperValidate::CarCategoryList($availableCarCategory)) throw new Exception('Не допустимая категория автомобиля');
        if ($placeCount < 0 ) throw new Exception('Не допустимое кол-во мест на этаже');
        $this->availableCarCategory = $availableCarCategory;
        $this->placeCount = $placeCount;
        $this->placeTaken = 0;
    }

    public function takeCar(car $car): bool {
        if (!in_array($car->getCategory(), $this->availableCarCategory)) return false;
        if ($this->placeTaken >= $this->placeCount) return false;
        $this->placeTaken++;
        return true;
    }
}

class Parking implements InterfaceParking {
    /**
     * @var ParkingFloor[]
     */
    private array $floors;

    public function __construct() {
        $this->floors = [];
    }

    public function addFloor(ParkingFloor $floor) {
        $this->floors[] = $floor;
    }

    public function takeCar(Car $car): bool {
//        var_dump($car);
        for ($i = count($this->floors) - 1; $i >= 0; $i--) {
            if ($this->floors[$i]->takeCar($car)) return true;
        }
        return false;
    }
}