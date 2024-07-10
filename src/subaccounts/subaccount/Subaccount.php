<?php 

namespace Fdvice\subaccounts\subaccount ;
use Fdvice\CurlHelper;

final class Subaccount  implements SubaccountInterface
{
    public  function addSubaccount($in_data , $credentials):array{
        $url = "https://flespi.io/platform/subaccounts" ;
        $curl = CurlHelper::post($url , $in_data ,$credentials);
        $response = CurlHelper::excuteCurl($curl);
        
        return $response ;

    }


    public function loginEmailPasswd(SubaccountDto $subaccount) : array {
        $url = "https://flespi.io/auth/login/credentials" ;
        $curl = CurlHelper::post($url , $subaccount->loginEmailPasswdData() , null);
        $response = CurlHelper::excuteCurl($curl);

        return $response ;

    }


    public function loginPasswdLess(SubaccountDto $subaccount) : array{

        // $url = "https://flespi.io/auth/login/credentials" ;
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "auth") ;
        $url = $url ."/login/passwordless" ;

        // var_dump($url) ;
        // die() ;

        $curl = CurlHelper::post($url , $subaccount->loginPasswdLessData() , null);
        $response = CurlHelper::excuteCurl($curl);

        return $response ;
        return [] ;
    }

    // public function changePasswd($passwd , $credentials)  {

    //     $in_data = ["password"=>$passwd , "confirmation"=>$passwd] ;
    //     $url="https://flespi.io/auth/password";

    //     $curl =  CurlHelper::put($url , $in_data , $credentials) ;
        
    //     $response = CurlHelper::excuteCurl($curl);
        
    //     return $response ; 
    // }

    
    public  function getSubaccount($dataQuery , $credentials):array{

        $selector = $dataQuery["selector"] ;
        $url = "https://flespi.io/platform/subaccounts/". ($selector != null ? "$selector" : "all")."?fields=".
        join(",",$dataQuery["fields"]);
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: ".$credentials,
                "Accept: */*"
            ],
        ]);

        $response = CurlHelper::excuteCurl($curl);

        return $response;

    }
    public  function deleteSubaccount(SubaccountDto $subaccountDto , $credentials):array{

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "subaccount") ;
        $url = $url . "/" .join(",",$subaccountDto->getIds()) ;
        // $url = "https://flespi.io/platform/subaccounts/".join(",",$selector) ;

        $curl = CurlHelper::delete($url  ,$credentials);
        $response = CurlHelper::excuteCurl($curl);
        return $response ;
    }
    public  function updateSubaccount($in_data , $selector , $credentials):array{
        $url="https://flespi.io/platform/subaccounts/".$selector ;
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL =>$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => json_encode($in_data, JSON_PRETTY_PRINT),
            CURLOPT_HTTPHEADER => [
                "Authorization: ".$credentials,
                "Content-Type: application/json" ,
                "Accept: */*"
            ],
        ]);
        
        $response = CurlHelper::excuteCurl($curl);

        return $response ;
    }


    public function createToken($in_data ,
     $subaccountId  , $credentials):array{


        $url = "https://flespi.io/platform/tokens";

        $additional_headers = [
            "x-flespi-cid: ".$subaccountId
        ];

        $curl = CurlHelper::post_with_additional_header($url , 
        $in_data ,$additional_headers ,$credentials);
        $response = CurlHelper::excuteCurl($curl);
        
        return $response ;
    }
}
