<?php

namespace Fdvice\channel\manage;
use Fdvice\channel\manage\ChannelDto ;
use Fdvice\CurlHelper ;



final class Channel implements ChannelInterface
{
    function createChannel($in_data , $credentials):array{
        $url = "https://flespi.io/gw/channels";
        $curl = CurlHelper::post($url,$in_data , $credentials);
        $response = CurlHelper::excuteCurl($curl);
        
        return $response ;
        
    }

    function getChannelinfo($dataQuery , $credentials):array{
        $selector = $dataQuery["ch-selector"] ;

        $url = "https://flespi.io/gw/channels/". ($selector != null ?join(",",$selector) : "all")."?fields=".
        join(",",$dataQuery["fields"]);


        $curl = CurlHelper::get($url , $credentials);
        $response = CurlHelper::excuteCurl($curl) ; 

        return $response ;
    }

    function getChannelinfoUsingDevice(ChannelDto $channeldto  , $credentials , $loadPath){


        $channels = CurlHelper::loadDataJson($loadPath)["result"] ;
        $target_channel = null ;
        foreach ($channels as $item) {
            # code
            if (isset($item["protocol_id"]) && $item["protocol_id"] == $channeldto->getProtocol_id()) {
                $target_channel = $item ;
                break   ;
            }
        }

        return $target_channel ; 
  
    }
}
