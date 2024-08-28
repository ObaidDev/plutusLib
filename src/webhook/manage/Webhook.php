<?php

namespace Fdvice\webhook\manage ;
use Fdvice\CurlHelper ;


final class Webhook  implements WebhookInterface
{
    public function addWebhook(WebhookDto $webhookDto , $userToken): array
    {

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "webhook") ;

        
        $curl = CurlHelper::post($url , [$webhookDto->_create()] , $userToken) ;
        

        return CurlHelper::excuteCurl($curl) ;
        
    }


    public function deleteWebhook(WebhookDto $webhookDto , $userToken): array
    {

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "webhook") ;
        $url = $url . ($webhookDto->getIds() !=null ? "/".join("," , $webhookDto->getIds()):"") ;


        $curl = CurlHelper::delete($url , $userToken) ;
        
        return CurlHelper::excuteCurl($curl) ;
        
    }

    public  function updateWebhook(WebhookDto $webhookDto , $userToken):array {

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "webhook") ;
        $url = $url . ($webhookDto->getIds() !=null ? "/".join("," , $webhookDto->getIds()):"") ;
        $url = $url."?fields=".join(",",$webhookDto->getFields()) ;

        $curl = CurlHelper::put($url,$webhookDto->_update(), $userToken) ;
        

        return CurlHelper::excuteCurl($curl) ;

    }
}
