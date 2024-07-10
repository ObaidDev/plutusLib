<?php

namespace Fdvice\geofence\manage;



interface GeofenceInterface {

    function addGeofence(GeofenceDto $geofence , $userToken):array;
    function deleteGeofence(GeofenceDto $geofence , $userToken):array;

    function updateGeofence(GeofenceDto $geofence , $userToken):array ; 
}
