<?php

namespace Fdvice\webhook ;


use Fdvice\webhook\manage\WebhookInterface ;
use Fdvice\webhook\manage\Webhook ;
use Fdvice\webhook\manage\WebhookDto ;

final class WebhookFacade
{
    private static WebhookInterface $webhook;


    function __construct()
    {
        self::$webhook =  new Webhook() ;
    }

    function addWebhook(WebhookDto $webhookDto , $userToken) : array {

        $res = self::$webhook->addWebhook($webhookDto , $userToken) ;
        return $res ;
        
    }

    function deleteWebhook(WebhookDto $webhookDto , $userToken) : array {
        $res = self::$webhook->deleteWebhook($webhookDto , $userToken) ;
        return $res ;
    }
    
}
