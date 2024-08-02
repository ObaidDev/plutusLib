<?php

namespace Fdvice\webhook\manage ;
use Fdvice\CurlHelper ;


final class Webhook  implements WebhookInterface
{
    function addWebhook(WebhookDto $webhookDto , $userToken): array
    {

        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "webhook") ;
        $url = $url ;

        // var_dump($url) ;
        // die() ;
        
        $curl = CurlHelper::post($url , [$webhookDto->_create()] , $userToken) ;
        
        $response = CurlHelper::excuteCurl($curl);

        return $response ;
        
    }
}
