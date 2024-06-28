<?php

namespace Fdvice\subaccounts\limit ; 

use Fdvice\CurlHelper;

final class Limit implements LimitInterface
{
    public function __construct()
    {

    }

    function addLimit(array $limits , $userToken) : array {

        $limits = array_map(function($limit){
            return $limit() ;
        },$limits) ;
        
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "limit") ;
        $curl = CurlHelper::post($url , $limits ,$userToken);
        $response = CurlHelper::excuteCurl($curl);
        
        return $response ;
        // return [$url] ;
    }
}
