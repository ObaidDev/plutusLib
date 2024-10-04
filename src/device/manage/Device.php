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
        $moreHedersParams = ($device->getCid() != null ? ["x-flespi-cid:".$device->getCid()] :  []) ;

        $curl = CurlHelper::post_with_additional_header($url , [$device()], $moreHedersParams, $credentials) ;
        // $curl = CurlHelper::post($url , [$device()], $credentials) ;

        $response = CurlHelper::excuteCurl($curl);

        return $response ;

    }

    function getDeviceinfo(DeviceDto $deviceDto , $credentials):array {
        // $selector = $dataQuery["selector"] ;

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "device") ;
        $url = $url ."/". ($deviceDto->getIds() != null ? $deviceDto->getIds() : "all")."?fields=".
        ($deviceDto->getFields() != null ?join(",",$deviceDto->getFields()) : "all");;

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

        $url= CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "device") ;
        $url = $url."/".join(",",$deviceDto->getIds()). "?fields=" . ($deviceDto->getFields() != null ? join("," , $deviceDto->getFields()) : "") ;
        $moreHedersParams = ($deviceDto->getCid() != null ? ["x-flespi-cid:".$deviceDto->getCid()] :  []) ;

        $curl =  CurlHelper::putAdditionalHeader($url , $deviceDto->_update(),$moreHedersParams  , $userToken) ;

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


    function getSettings(DeviceDto $deviceDto , $credentials):array {
        // $selector = $dataQuery["selector"] ;

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "device") ;
        $url = $url ."/". ($deviceDto->getIds() != null ? join("," ,  $deviceDto->getIds()) : "all")
        ."/settings/".($deviceDto->getSelectors() != null ? join("," ,  $deviceDto->getSelectors()) : "all")."?fields=" ;
        // ($deviceDto->getFields() !=null ? join(",",$deviceDto->getFields()) : "");

        $curl = CurlHelper::get($url , $credentials) ;

        $response = CurlHelper::excuteCurl($curl);

        return $response ;
    }


    function getDevicesTelemetry(DeviceDto $deviceDto , $credentials):array{

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "device") ;
        $url = $url ."/". ($deviceDto->getIds() != null ? $deviceDto->getIds() : "all")."/telemetry/".
        ($deviceDto->getFields() != null ?join(",",$deviceDto->getFields()) : "all");

        // var_dump($url) ;
        // die() ;
        $curl = CurlHelper::get($url , $credentials) ;

        $response = CurlHelper::excuteCurl($curl);

        return $response ;

    }


    function getDevicesMessages(DeviceDto $deviceDto , $credentials):array{

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "device") ;
        $url = $url ."/". ($deviceDto->getIds() != null ? $deviceDto->getIds() : "all")."/messages".
        "?data=".urlencode(json_encode($deviceDto->getData()));

        // var_dump($url) ;
        // die() ;
        $curl = CurlHelper::get($url , $credentials) ;

        $response = CurlHelper::excuteCurl($curl);

        return $response ;

    }

}
