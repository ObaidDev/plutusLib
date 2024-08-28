<?php

namespace Fdvice\webhook ;


use Fdvice\webhook\manage\WebhookInterface ;
use Fdvice\webhook\manage\Webhook ;
use Fdvice\webhook\manage\WebhookDto ;

final class WebhookFacade
{
    private static WebhookInterface $webhook;


    public function __construct()
    {
        self::$webhook =  new Webhook() ;
    }

    public function addWebhook(WebhookDto $webhookDto , $userToken) : array {

        return self::$webhook->addWebhook($webhookDto , $userToken) ;
        
    }

    public function deleteWebhook(WebhookDto $webhookDto , $userToken) : array {
        return self::$webhook->deleteWebhook($webhookDto , $userToken) ;
    }

    public function updateWebhook(WebhookDto $webhookDto , $userToken) : array {
        // $res =  ;
        return self::$webhook->updateWebhook($webhookDto , $userToken) ;
    }
    
}
