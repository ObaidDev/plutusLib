<?php

namespace Fdvice\mqtt;

use Fdvice\mqtt\rest\MqttRest;
use Fdvice\mqtt\rest\MqttInterface;

class MqttFacade {

    private static MqttInterface $mqttRest;

    function __construct()
    {
        self::$mqttRest =  new MqttRest() ;

    }


    public function killUnusedSessions($userToken): array {
        $res = self::$mqttRest->killUnusedSessions($userToken);
        return $res;
    }

}