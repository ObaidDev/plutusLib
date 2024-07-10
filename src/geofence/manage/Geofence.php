<?php

namespace Fdvice\geofence\manage;

use Fdvice\CurlHelper ;



final class Geofence implements GeofenceInterface {

    function addGeofence(GeofenceDto $geofenceDto, $userToken): array
    {

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "geofence") ;
        // $url = $url . "/".join(",",$pluginDto->getIds()) ;

        $moreHedersParams = ($geofenceDto->getCid() != null ? ["x-flespi-cid:".$geofenceDto->getCid()] :  []) ;        
        $curl = CurlHelper::post_with_additional_header($url , [$geofenceDto->_create()], $moreHedersParams , $userToken) ;
        
        $response = CurlHelper::excuteCurl($curl);

        return $response ;
        
        return [] ;
    }

    function deleteGeofence(GeofenceDto $geofenceDto, $userToken) : array {
        
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "geofence") ;
        $url = $url . "/".join(",",$geofenceDto->getIds()) ;
        // $url = "https://flespi.io/gw/devices/".join(",",$selector) ;

        $curl = CurlHelper::delete($url , $userToken) ;
        $response = CurlHelper::excuteCurl($curl);

        return $response ;

        return [] ;
    }
    

    function updateGeofence(GeofenceDto $geofenceDto , $userToken): array{

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "geofence") ;
        $url = $url . "/".join(",",$geofenceDto->getIds()) ;
        
        // var_dump($url) ;
        // die() ;

        $curl =  CurlHelper::put($url , $geofenceDto->_create() , $userToken) ;
        
        $response = CurlHelper::excuteCurl($curl);
        
        return $response ;


        return [] ;
    }
}

