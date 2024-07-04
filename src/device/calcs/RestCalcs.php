<?php


namespace Fdvice\device\calcs ;
use Fdvice\CurlHelper ;
use Fdvice\device\manage\DeviceDto ;

final class RestCalcs  implements RestCalcsInterface
{
    function dirctlyExcuteReport(DeviceDto $deviceDto , SelectorsInterface $selector , $userToken) :array{

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "device") ;
        // $url = $url . "/".join(",",$pluginDto->getIds()) ;
        $url = $url. "/".join( ",", $deviceDto->getIds())."/calculate" ;
        // var_dump($url) ;
        // die() ;

        $selectors = ["selectors"=>[$selector->_create()]] ;

        //? build the selector and merge it with the counters .
        $selectors = array_merge($selectors , 
        ["counters"=>$selector->getCounters() , "from"=>$selector->getFrom() , 
        "to"=>$selector->getTo()]) ;

        return CurlHelper::excuteCurl(CurlHelper::post($url , $selectors , $userToken)) ;

        return [] ;
    }
}
