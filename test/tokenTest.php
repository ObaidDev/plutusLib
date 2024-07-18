<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Fdvice\tokens\token\TokenDto ;
use Fdvice\tokens\TokenFacade ;


$userToken = "AREdJ7wT3vXkiUTH8A2t6edx5CWqiAOGijKPe4w7pjgw3Z11pTikVkFOMq5TQHpW" ;

$tokenFacade = new TokenFacade() ;


$tokenDto = TokenDto::emptyConstruct() ;
$tokenDto->setEndPointParam(["key"=>$userToken]) ;

$response = $tokenFacade->getToken($tokenDto , $userToken) ;

var_dump($response) ;