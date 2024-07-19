<?php
namespace Fdvice\device\manage;
use Fdvice\CurlHelper;

use Fdvice\device\manage\DeviceDto ;

class Device  implements DeviceInterface  
{

    function addDevice($device, $credentials):array{
        // echo json_encode(new Device($in_data), JSON_PRETTY_PRINT);
        // echo "data json encode using just data dirctly".json_encode($in_data, JSON_PRETTY_PRINT);
        
        // ["x-flespi-cid"=>$device->getCid()]
        $url = "https://flespi.io/gw/devices" ;
        $curl = CurlHelper::post_with_additional_header($url , [$device()], ["x-flespi-cid:".$device->getCid()], $credentials) ;
        // $curl = CurlHelper::post($url , [$device()], $credentials) ;
        
        $response = CurlHelper::excuteCurl($curl);
        
        return $response ;

    }

    function getDeviceinfo(DeviceDto $deviceDto , $credentials):array {
        // $selector = $dataQuery["selector"] ;
        
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "device") ;
        $url = $url ."/". ($deviceDto->getIds() != null ? $deviceDto->getIds() : "all")."?fields=".
        join(",",$deviceDto->getFields());

        $curl = CurlHelper::get($url , $credentials) ;

        $response = CurlHelper::excuteCurl($curl);
        
        return $response ; 
    }


    function deleteDevice(DeviceDto $deviceDto , $userToken):array{
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "device") ;
        $url = $url . "/".join(",",$deviceDto->getIds()) ;
        // $url = "https://flespi.io/gw/devices/".join(",",$selector) ;

        $curl = CurlHelper::delete($url , $userToken) ;
        $response = CurlHelper::excuteCurl($curl);

        return $response ;
    }

    function updateDevice(DeviceDto $deviceDto , $userToken):array{

        // url = https://flespi.io/gw/devices/5720023/cid
        // body : {"cid":1879795}
        $url="https://flespi.io/gw/devices/".join(",",$deviceDto->getIds());
        
        $curl =  CurlHelper::put($url , $deviceDto->_update() , $userToken) ;
        
        $response = CurlHelper::excuteCurl($curl);
        
        return $response ; 
    }

    function moveDeivceToSubaccounte($cid , $ids , $credentials):array{
        $url="https://flespi.io/gw/devices/".join(",",$ids)."/cid";
        $in_data = ["cid"=>$cid] ;
        $curl = CurlHelper::put($url , $in_data , $credentials) ;
        $response = CurlHelper::excuteCurl($curl);
        
        return $response ; 
    }

    function getListDevices($data_Query , $credentials) : array {
        $channel = $data_Query["channel-protocols.selector"] ;
        $devtypes = $data_Query["devtypes"];
        $fields = $data_Query["fields"];

        $url = "https://flespi.io/gw/channel-protocols/".($channel != null ? join(",",$channel) : "all").
        "/device-types/".($devtypes != null ? join(",",$devtypes) : "all")."?fields=".join("," , $fields);

        $curl = CurlHelper::get($url , $credentials) ;
        
        $response = CurlHelper::excuteCurl($curl);
        
        return $response ;
        
    }
}
