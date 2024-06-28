<?php


namespace Fdvice\auth\passwd ;
use Fdvice\CurlHelper ;





final class Passwd  implements PasswdInterface
{
    function updatePasswd($passwdDto , $credentials) : array {

        $url="https://flespi.io/auth/password";
        $curl =  CurlHelper::put($url , $passwdDto() , $credentials) ;
        $response = CurlHelper::excuteCurl($curl);
        
        return $response ; 
    }

}