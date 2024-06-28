<?php

namespace Fdvice\realms\user ;
use Fdvice\CurlHelper;


class User  implements UserInterface {
    // Subaccount is a regular platform user restricted by owner limits.
    public function realmCreateUser($user ,$realmId , $credentials):array{

    
            $url = "https://flespi.io/platform/realms/".$realmId
            ."/users" ;
            $curl = CurlHelper::post($url , [$user] ,$credentials);
            $response = CurlHelper::excuteCurl($curl);
         
        return $response ;
    }
    

    public  function login($user):array{
        $realmPublicId = $user->getRealmPublicId() ;
        $url = "https://flespi.io/realm/".$realmPublicId."/login" ;

        $credentials = null ;
        $curl = CurlHelper::post($url , $user->loginData() ,$credentials);
        $response = CurlHelper::excuteCurl($curl);
         
        return $response ;

    }

}