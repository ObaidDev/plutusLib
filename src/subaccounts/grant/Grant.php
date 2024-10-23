<?php

namespace Fdvice\subaccounts\grant ;
use Fdvice\CurlHelper;
use Fdvice\subaccounts\subaccount\SubaccountDto ;


final class Grant implements GrantInterface
{

    function addGrante(GrantDto $grantDto , $userToken) : array
    {

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "grant") ;
        $curl = CurlHelper::post($url , [$grantDto()] ,$userToken);
        $response = CurlHelper::excuteCurl($curl);
        
        return $response ;
        
    }

    function deleteGrant(GrantDto $grantDto , $userToken) : array{
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "grant") ;
        $url = $url ."/".join("," , $grantDto->getIds()) ;
        // var_dump($url);
        // die() ;
        $curl = CurlHelper::delete($url  ,$userToken);
        $response = CurlHelper::excuteCurl($curl);


        return $response ;
    }


    public function grantToSubaccount(GrantDto $grantDto, SubaccountDto $subaccount, $userToken) : array {

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "grant") ;
        $url = $url ."/".join("," , $grantDto->getIds())."/subaccounts/".join("," , $subaccount->getIds());

        return  CurlHelper::excuteCurl(
                        CurlHelper::post($url , NULL ,$userToken)
        );

        // return [] ;
    }

    
}
