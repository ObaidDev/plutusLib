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

        $url = "https://flespi.io/platform/realms" ;
        $curl = CurlHelper::post($url , $realms ,$credentials);
        $response = CurlHelper::excuteCurl($curl);


        return $response ;
    }
    

}