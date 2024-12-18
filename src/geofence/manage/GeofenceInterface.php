<?php

namespace Fdvice\geofence\manage;



interface GeofenceInterface {

    function addGeofence(GeofenceDto $geofence , $userToken):array;
    function deleteGeofence(GeofenceDto $geofence , $userToken):array;

    function updateGeofence(GeofenceDto $geofence , $userToken):array ;

    function getGeofences(GeofenceDto $geofence , $userToken):array ;

    function assignGeofenceToCalc(GeofenceDto $geofence , $userToken):array ;
    function assignGeofenceToPlugin(GeofenceDto $geofence , $userToken):array ;
    function assignGeofenceToDevice(GeofenceDto $geofence , $userToken):array ;

    
}
