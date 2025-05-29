<?php

namespace Fdvice\realms\realm ;
use Fdvice\CurlHelper;


class Realm  implements RealmInterface {
    // Subaccount is a regular platform user restricted by owner limits.
    public function addRealm($realms , $credentials):array{
        
        $realms = array_map(function($realm){
            // var_dump($realm()) ;
            return $realm() ;
        },$realms) ;
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "realms") ;
        // $url = "https://flespi.io/platform/realms" ;
        $curl = CurlHelper::post($url , $realms ,$credentials);
        $response = CurlHelper::excuteCurl($curl);


        return $response ;
    }


    public function getRealm(RealmDto $realmDto , $credentials) :array {

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "realms") ;
        $url = $url."/".join("," , $realmDto->getIds()) ;

        $curl = CurlHelper::get($url , $credentials) ;
        $response = CurlHelper::excuteCurl($curl);

        return $response ;
        return [] ;
    }
    

}
