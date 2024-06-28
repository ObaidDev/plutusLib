<?php

namespace Fdvice\subaccounts\limit ;


// final so can't extenteded

final class LimitDto
{
    private $devices_count = -1;
    private $device ;

    public function __construct()
    {
    }

    public static function create($devices_count)
    {
        $limit = new LimitDto() ;
        $limit->setDevicesCount($devices_count) ;

        return $limit ;
    }

    function getDevice() { 
         return $this->device; 
    } 
    
    function setDevice($device) {  
        $this->device = $device; 
    } 

    function getDevicesCount() { 
         return $this->devices_count; 
    } 
    
    function setDevicesCount($devices_count) {  
        $this->devices_count = $devices_count; 
    }


    function __invoke(): array {
        $data = [
           "devices_count"=>$this->getDevicesCount()
        ] ;
        // ($this->getDevicesCount() != null) ? $data["devices_count"]=$this->getDevicesCount():$data ;

        return $data ;
    }
    
}


