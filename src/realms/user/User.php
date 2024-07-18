<?php

namespace Fdvice\realms\user ;
use Fdvice\CurlHelper;
use Fdvice\realms\user\UserDto ;


class User  implements UserInterface {
    // Subaccount is a regular platform user restricted by owner limits.
    public function realmCreateUser(UserDto $user  , $credentials):array{

        $url = "https://flespi.io/platform/realms/".$user->getRealmId()
        ."/users" ;
        $curl = CurlHelper::post($url , [$user()] ,$credentials);
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