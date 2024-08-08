<?php

namespace Fdvice\webhook\manage ;

interface WebhookInterface {

    public  function addWebhook(WebhookDto $webhookDto , $credentials):array;
    public  function deleteWebhook(WebhookDto $webhookDto , $credentials):array;



}