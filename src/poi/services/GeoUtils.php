<?php

namespace Fdvice\poi\services ;

use Fdvice\poi\interfaces\Point ;



class GeoUtils {
    
    /**
     * Calculate the Haversine distance between two points.
     * 
     * @param Point $point1 The first point.
     * @param Point $point2 The second point.
     * @return float The distance in kilometers.
     */
    public static function haversineDistance(Point $point1, Point $point2): float {
        $earthRadius = 6371; // Earth's radius in kilometers

        $lat1 = deg2rad($point1->getLatitude());
        $lon1 = deg2rad($point1->getLongitude());
        $lat2 = deg2rad($point2->getLatitude());
        $lon2 = deg2rad($point2->getLongitude());

        $deltaLat = $lat2 - $lat1;
        $deltaLon = $lon2 - $lon1;

        $a = sin($deltaLat / 2) ** 2 +
             cos($lat1) * cos($lat2) * sin($deltaLon / 2) ** 2;

        $c = 2 * asin(sqrt($a));

        return $earthRadius * $c;
    }



}