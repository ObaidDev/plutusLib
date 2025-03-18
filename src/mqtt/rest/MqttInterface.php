<?php


namespace Fdvice\mqtt\rest;

interface MqttInterface
{

    public function killUnusedSessions($userToken): array;
    
}
