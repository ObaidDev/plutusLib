<?php


namespace Fdvice\auth\passwd ;
use Fdvice\CurlHelper ;





final class Passwd  implements PasswdInterface
{
    function updatePasswd($passwdDto ,$subaccountId, $credentials) : array {

        $url="https://flespi.io/auth/password";
        $curl =  CurlHelper::putAdditionalHeader($url , $passwdDto(), ["x-flespi-cid"=>$subaccountId] , $credentials) ;
        $response = CurlHelper::excuteCurl($curl);
        
        return $response ; 
    }

}