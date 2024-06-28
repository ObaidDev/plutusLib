<?php 

namespace Fdvice\tokens\token ;

use Fdvice\CurlHelper;

class Token  implements TokenInterface
{
    public  function addSubaccountToken($tokens ,
            $subaccountId  , $credentials):array{

            $url = "https://flespi.io/platform/tokens";

            $tokens = array_map(function($token){
                return $token() ;
            },$tokens) ;

            $additional_headers = [
                "x-flespi-cid: ".$subaccountId
            ];

            $curl = CurlHelper::post_with_additional_header($url , 
            $tokens ,$additional_headers ,$credentials);
            $response = CurlHelper::excuteCurl($curl);
            
            return $response ;

    }



    function creatUserToken($tokens , $credentials) : array {

        // $url = "https://flespi.io/platform/tokens";

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "token") ;

        $header = $tokens[0]->getOwnerId() !== null ?["x-flespi-cid:".$tokens[0]->getOwnerId()] : null;
        $tokens = array_map(function($token){
            return $token() ;
        },$tokens) ;
        
        $curl = CurlHelper::post_with_additional_header($url ,$tokens , $header ,$credentials);
        $response = CurlHelper::excuteCurl($curl);
        
        return $response ;
    }

    public  function updateToken(TokenDto $token ,$userToken):array{
      $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "token") ;
      $url = $token->getTokenId() == null ? $url."/"."000001" : $url."/".$token->getTokenId();
      // $url = $url."/".$token->getTokenId() ;
      $curl = CurlHelper::put($url ,$token(),$userToken);
      $response = CurlHelper::excuteCurl($curl);
      return $response ;

    }

    public function deleteToken (TokenDto $token ,$userToken):array {
      $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "token") ;
      $url = $url."/".$token->getTokenId() ;
      $curl = CurlHelper::delete($url , $userToken) ;
      $response = CurlHelper::excuteCurl($curl);
      return $response ;
    }

}
