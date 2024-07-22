<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Fdvice\device\FacadeDevice ;
use Fdvice\device\manage\DeviceDto ;



$facade = new FacadeDevice() ;

$deviceDto = DeviceDto::emptyConstruct();
$deviceDto->setIds([5840189]) ;
// $deviceDto->setEnabled(true) ;
$deviceDto->setName("hellogogo") ;
$deviceDto->setFields(["id"]) ;

// $deviceDto->setIds([]) ;
// $deviceDto->setFields(["id","name"]) ;

$userToken = "AREdJ7wT3vXkiUTH8A2t6edx5CWqiAOGijKPe4w7pjgw3Z11pTikVkFOMq5TQHpW" ;

$response = $facade->updateDevice($deviceDto , $userToken) ;

var_dump($response) ;