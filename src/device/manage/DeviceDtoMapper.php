<?php

namespace Fdvice\device\manage;



class DeviceDtoMapper {


    public static function toDevicesDto ($devices , $deviceTypeId) :  array{

        // $startTime = microtime(true);

        $devices = array_map(function ($deviceDto) use  ($deviceTypeId){
            
            $deviceDto = DeviceDto::emptyConstruct()
                        ->setIdent($deviceDto["ident"])
                        ->setDevice_type_id($deviceTypeId)
                        ->setName($deviceDto["name"]) 
                        ->setPhone($deviceDto["phone"] ?? null);
            return $deviceDto() ;
        } , $devices) ;
        
        // echo "DevicesDto Mapping time: " .  microtime(true) - $startTime . " seconds\n";
        return $devices ;
    }


}