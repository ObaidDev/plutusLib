<?php


namespace Fdvice\plugins\manage ;
use Fdvice\CurlHelper ;

final class Plugin implements PluginInterface
{
    public function addPlugin(PluginDto $pluginDto , $userToken): array
    {
     
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "plugin") ;
        // $url = $url . "/".join(",",$pluginDto->getIds()) ;

        $moreHedersParams = ($pluginDto->getCid() != null ? ["x-flespi-cid:".$pluginDto->getCid()] :  []) ;        
        $curl = CurlHelper::post_with_additional_header($url , [$pluginDto->_create()], $moreHedersParams , $userToken) ;
        
        $response = CurlHelper::excuteCurl($curl);

        return $response ;
        


        return [] ;
    }



    public function addPlugins($pluginsDto , $userToken): array
    {
     
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "plugin") ;

        $moreHedersParams = ($pluginsDto[0]->getCid() != null ? ["x-flespi-cid:".$pluginsDto[0]->getCid()] : null ) ;

        // */ here we convert the plugin dto object to there excpeted array form that wil be acciptable from flespi
        
        $pluginsDto = array_map(function ($pluginDto) {
            return $pluginDto->_create() ;
        }, $pluginsDto) ;

        $curl = CurlHelper::post_with_additional_header($url , $pluginsDto, $moreHedersParams , $userToken) ;
        
        $response = CurlHelper::excuteCurl($curl);

        return $response ;
        


        return [] ;
    }
}
