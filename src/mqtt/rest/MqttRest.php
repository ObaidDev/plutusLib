<?php

namespace Fdvice\mqtt\rest;
use Fdvice\CurlHelper;


class MqttRest implements MqttInterface {


    public function killUnusedSessions($userToken): array
    {
        $url = CurlHelper::getEndpointUrl(__DIR__."/../../../config/endpoints.json" , "restMqtt") ;

        $url = $url . '/sessions/connected=false';

        $curl = CurlHelper::delete($url , $userToken) ;
        $response = CurlHelper::excuteCurl($curl);

        return $response ;
    }



}

