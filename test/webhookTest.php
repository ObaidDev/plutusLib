<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Fdvice\webhook\manage\WebhookDto ;
use Fdvice\webhook\manage\Webhook ;
use Fdvice\webhook\WebhookFacade ;
use Fdvice\webhook\manage\TriggerDto ;
$userToken = "AREdJ7wT3vXkiUTH8A2t6edx5CWqiAOGijKPe4w7pjgw3Z11pTikVkFOMq5TQHpW" ;
$webhookFacade = new WebhookFacade() ;

$trigger1 = TriggerDto::emptyConstruct() ;
$trigger1->setTopic("flespi/state/gw/devices/+/+") ;
// $triger1->fil
$triggers = [$trigger1] ;

$webhookDto = WebhookDto::createWebhook("webhook1" , $triggers , "https://fleety.plutus.ma/api/overspeed") ;

$res = $webhookFacade->addWebhook($webhookDto , $userToken) ;
var_dump($res) ;

// var_dump($webhookDto->_create()) ;