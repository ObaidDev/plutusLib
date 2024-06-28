<?php

namespace Fdvice\subaccounts\grant ;
use Fdvice\CurlHelper;


final class Grant implements GrantInterface
{

    function addGrante(GrantDto $grantDto , $userToken) : array
    {

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "grant") ;
        $curl = CurlHelper::post($url , [$grantDto()] ,$userToken);
        $response = CurlHelper::excuteCurl($curl);
        
        return $response ;
        
    }
    
}
