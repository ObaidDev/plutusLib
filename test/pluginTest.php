<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Fdvice\plugins\manage\PluginDto ;
use Fdvice\plugins\manage\PluginInterface ;
use Fdvice\plugins\FacadePlugin ;




$facadePlugin = new FacadePlugin() ;
$userToken = "AREdJ7wT3vXkiUTH8A2t6edx5CWqiAOGijKPe4w7pjgw3Z11pTikVkFOMq5TQHpW" ;

$pluginDto = PluginDto::emptyConstruct() ;


$response = $facadePlugin->getPlugins($pluginDto , $userToken) ;
var_dump($response) ;
