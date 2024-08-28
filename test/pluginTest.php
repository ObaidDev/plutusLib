<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Fdvice\device\manage\DeviceDto;
use Fdvice\plugins\manage\PluginDto ;
use Fdvice\plugins\manage\PluginInterface ;
use Fdvice\plugins\FacadePlugin ;




$facadePlugin = new FacadePlugin() ;
$userToken = "701KatdZ91CGSqdMNr3QuV7blh1GVfqZCipn5zUhm6F36tUKcFcS67QswxYJziew" ;

// $pluginDto = PluginDto::emptyConstruct() ;
// $deviceDto = DeviceDto::emptyConstruct() ;


// $response = $facadePlugin->getPlugins($pluginDto , $userToken) ;
// var_dump($response) ;*
// $pluginDto->setIds([1058264]) ;
// $deviceDto->setIds([5798349]) ;

// $response = $facadePlugin->assignDevice($pluginDto , $deviceDto , $userToken) ;


$pluginDto = PluginDto::emptyConstruct();
$response = $facadePlugin->getPlugins($pluginDto , $userToken) ;

var_dump($response) ;
