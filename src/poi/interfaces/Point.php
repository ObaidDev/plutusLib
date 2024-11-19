<?php

namespace Fdvice\poi\interfaces ;

interface Point {
    /**
     * Get the latitude of the point.
     * 
     * @return float Latitude in decimal degrees.
     */
    function getLatitude() : float;

    /**
     * Get the longitude of the point.
     * 
     * @return float Longitude in decimal degrees.
     */
    function getLongitude() : float;
}