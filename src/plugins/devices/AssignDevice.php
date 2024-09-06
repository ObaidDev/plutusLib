<?php


namespace Fdvice\plugins\devices ;
use Fdvice\CurlHelper ;

use Fdvice\plugins\manage\PluginDto ;
use Fdvice\device\manage\DeviceDto ;

final class AssignDevice implements AssignDeviceInterface
{
    function assignDevice(PluginDto $pluginDto , DeviceDto $deviceDto,$userToken) : array{

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "plugin") ;
        $url = $url . "/".join(",",$pluginDto->getIds()) ;
        $url = $url ."/devices/" .join(",",$deviceDto->getIds()) ;

        $moreHedersParams = ($pluginDto->getCid() != null ? ["x-flespi-cid:".$pluginDto->getCid()] :  []) ;        
        
        // var_dump($url) ;
        // die();
        $curl = CurlHelper::post($url , null , $userToken) ;
        
        $response = CurlHelper::excuteCurl($curl);

        return $response ;


        return  [] ;
    }

    function unAssignDevice(PluginDto $pluginDto , DeviceDto $deviceDto,$userToken) : array {
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "plugin") ;
        $url = $url . "/".join(",",$pluginDto->getIds()) ;
        $url = $url ."/devices/" .join(",",$deviceDto->getIds()) ;

        $moreHedersParams = ($pluginDto->getCid() != null ? ["x-flespi-cid:".$pluginDto->getCid()] :  []) ;

        $curl = CurlHelper::delete($url , $userToken) ;
        
        $response = CurlHelper::excuteCurl($curl);

        return $response ;
    }
}