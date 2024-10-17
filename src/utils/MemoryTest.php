<?php

namespace Fdvice\utils ;



final class MemoryTest
{

    static function createObject() {
        $ids = [1704111, 1704112, 1704113, 1704115, 1704116, 1704118 , 1704120];
        return (object)[
            'id' => $ids[array_rand($ids)],
            'name' => 'Device_' . rand(1, 1000),
            'status' => rand(0, 1),
            'duration' => rand(10, 120),
            'timestamp' => time(),
            'condition' => "duration > ".rand(200, 9000),
        ];
    }


    static function loadObjects(int $num_records) {
        $objectList = [];
    
        for ($i = 0; $i < $num_records; $i++) {
            $object = MemoryTest::createObject();
            
            if (!isset($objectList[$object->id])) {
                $objectList[$object->id] = [];
            }
            
            $objectList[$object->id][] = $object;
        }

        return $objectList;
    }

    static function getCalcId(string $topic) : int {
        return (int) explode("/" , $topic)[4] ;
    }


    static function findObjectsById($objects, $searchId) {
        return $objects[$searchId] ?? null;
    }


    private static function createDevice() {

        // Generate random device data
        return [
            'ident' => "9798798767890" . rand(10, 99),
            'deviceTypeId' => 1,
            'name' => 'Device_' . rand(1, 1000),
            'phone' => '+212' . rand(10000000, 99999999)
        ];
    }

    static function loadDevices(int $num_records) {
        $deviceList = [] ;
        for ($i = 0; $i < $num_records; $i++) {
            array_push($deviceList , MemoryTest::createDevice()) ;
        }

        return $deviceList;
    }
}