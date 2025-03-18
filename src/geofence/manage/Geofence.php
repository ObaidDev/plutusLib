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

    function assignGeofenceToCalc(GeofenceDto $geofence , $userToken):array{
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "calcs") ;
        $url = $url . "/".($geofence->getCalcsIds()!= null ? join(",",$geofence->getCalcsIds()) : "hello I am Obayd");
        $url = $url . "/geofences/".($geofence->getIds()!= null ? join(",",$geofence->getIds()) : "hello I am Obayd") ;

        $moreHedersParams = ($geofence->getCid() != null ? ["x-flespi-cid:".$geofence->getCid()] :  []) ;        
        $curl = CurlHelper::post_with_additional_header($url , NULL , $moreHedersParams , $userToken) ;
        
        $response = CurlHelper::excuteCurl($curl);

        return $response ;
    }

    function assignGeofenceToPlugin(GeofenceDto $geofence , $userToken):array {

        /**
         ** I used calcs url as base url and I will add to it geofence
         */
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "plugin") ;
        $url = $url . "/".($geofence->getpluginsIds()!= null ? join(",",$geofence->getpluginsIds()) : "* * * * * * * * * ");
        $url = $url . "/geofences/".($geofence->getIds()!= null ? join(",",$geofence->getIds()) : "* * * * * * * * * ") ;

        $moreHedersParams = ($geofence->getCid() != null ? ["x-flespi-cid:".$geofence->getCid()] :  []) ;        
        $curl = CurlHelper::post_with_additional_header($url , NULL , $moreHedersParams , $userToken) ;
        
        $response = CurlHelper::excuteCurl($curl);

        return $response ;
    }


    function getGeofences(GeofenceDto $geofenceDto , $userToken) : array{
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "geofence") ;
        $url = $url . "/".($geofenceDto->getIds() != null ?join(",",$geofenceDto->getIds()) : "all") ;
        $url = $url . ($geofenceDto->getFields() != null ? "?fields=".join("," , $geofenceDto->getFields()) : null) ;

        return CurlHelper::excuteCurl(
                        CurlHelper::get($url , $userToken)) ;
    }

    function assignGeofenceToDevice(GeofenceDto $geofence , $userToken):array {

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "device") ;
        $url = $url . "/".($geofence->getDevicesIds()!= null ? join(",",$geofence->getDevicesIds()) : "* * * * * * * * * * ");
        $url = $url . "/geofences/".($geofence->getIds()!= null ? join(",",$geofence->getIds()) : "* * * * * * * * * * "); ;

        // var_dump($url) ;
        // die() ;
        
        $moreHedersParams = ($geofence->getCid() != null ? ["x-flespi-cid:".$geofence->getCid()] :  []) ;        
        $curl = CurlHelper::post_with_additional_header($url , NULL , $moreHedersParams , $userToken) ;
        
        return CurlHelper::excuteCurl($curl);
    }



    function unassignGeofenceFromDevice(GeofenceDto $geofence, $userToken): array {
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json", "device") 
            . "/" . ($geofence->getDevicesIds() ? implode(",", $geofence->getDevicesIds()) : "* * * * * * * * * *")
            . "/geofences/" . ($geofence->getIds() ? implode(",", $geofence->getIds()) : "* * * * * * * * * *");

        $moreHedersParams = $geofence->getCid() ? ["x-flespi-cid:" . $geofence->getCid()] : [];
        
        return CurlHelper::excuteCurl(
            CurlHelper::delete($url, $userToken)
        );
    }
}

