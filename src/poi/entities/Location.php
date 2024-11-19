<?php

namespace Fdvice\poi\entities ;

use Fdvice\poi\interfaces\Point ;

class Location implements Point {

    private float $latitude;
    private float $longitude;

    public function __construct(float $latitude, float $longitude) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getLatitude(): float {
        return $this->latitude;
    }

    public function getLongitude(): float {
        return $this->longitude;
    }
}
