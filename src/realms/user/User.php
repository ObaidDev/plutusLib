<?php

namespace Fdvice\realms\user ;
use Fdvice\CurlHelper;
use Fdvice\realms\user\UserDto ;


class User  implements UserInterface {
    // Subaccount is a regular platform user restricted by owner limits.
    public function realmCreateUser(UserDto $user  , $credentials):array{

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "realm") ;

        $url = "https://flespi.io/platform/realms/".$user->getRealmId()
        ."/users" ;
        $curl = CurlHelper::post($url , [$user()] ,$credentials);
        $response = CurlHelper::excuteCurl($curl);
         
        return $response ;
    }
    

    public  function login(UserDto $user):array{

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "realm") ;

        $url = $url.'/'.$user->getRealmPublicId()."/login" ;

        $credentials = null ;
        $curl = CurlHelper::post(
            $url , 
            $user->loginData() ,
            $credentials
        ) ;
         
        return  CurlHelper::excuteCurl($curl) ;
    }

    public  function realmDeleteUser(UserDto $user , $userToken):array {
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "realms") ;
        $url = $url."/".$user->getRealmId()."/users/".join(",",$user->getIds()) ;
        // $moreHedersParams = ($user->getCid() != null ? ["x-flespi-cid:".$user->getCid()] :  []) ;
        $curl = CurlHelper::delete($url  , $userToken) ;
                
        return CurlHelper::excuteCurl($curl);

        return [] ;
    }

}