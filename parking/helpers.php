<?php
class HelperParking {
    public static function createParking(string $parkingCode): Parking {
        $arrPlaceCount = explode(' ', trim($parkingCode));
        $parking = new Parking();
        try {
            for ($i = 0; $i < count($arrPlaceCount); $i++) {
                if ($i === 0) {
                    $parking->addFloor(new ParkingFloor(['t', 'c'], (int)$arrPlaceCount[$i]));
                } else {
                    $parking->addFloor(new ParkingFloor(['c'], (int)$arrPlaceCount[$i]));
                }
            }
        } catch (Exception $e) {
            return new Parking();
        }

        return $parking;
    }
}

class HelperCars {
    /**
     * @param string $categoryListCode
     * @return Car[]
     */
    public static function CreateCarList(string $categoryListCode): array {
        $arrCategoryList = explode(' ', trim($categoryListCode));
        $arrCarList = [];
        try {
            foreach ($arrCategoryList as $item) {
                $arrCarList[] = new Car($item);
            }
        } catch (Exception $e) {
            return [];
        }
        return $arrCarList;
    }
}

class HelperValidate {
    private static array $knownCategory = ['t', 'c'];
    public static function CarCategoryOne (string $category): bool {
        return in_array($category, static::$knownCategory);
    }
    public static function CarCategoryList (array $categoryList): bool {
        foreach ($categoryList as $item) {
            if (!static::CarCategoryOne($item)) return false;
        }
        return true;
    }
}