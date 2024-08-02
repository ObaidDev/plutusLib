<?php

namespace Fdvice\webhook\manage ;

interface WebhookInterface {

    public  function addWebhook(WebhookDto $webhookDto , $credentials):array;



}