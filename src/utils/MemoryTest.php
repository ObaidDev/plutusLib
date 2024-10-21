<?php

namespace Fdvice\utils ;



final class MemoryTest
{



    static function createUserObject($clca_type) {
        $channels = ['email', 'whatsapp', 'sms'];
        $user_id = rand(1000, 9999);

        // $condition = $clca_type === 'type1' ? rand(100, 3000) : rand(500, 9000);

        return [
            'user_id' => $user_id,
            'condition' => "duration >= ".rand(10 , 100),
            'preferences' => [
                'channel' => $channels[array_rand($channels)],
                'notify' => rand(0, 1) ? true : false
            ]
        ];
    }

    static function createDeviceObject($clca_type, int $num_users) {
        $device_id = rand(5842053 , 6015337);
        // $device_id = rand(5842053, 6008097);
        // $device_id = $device_ids[array_rand($device_ids)];

        $users_list = [];

        for ($i = 0; $i < $num_users; $i++) {
            $users_list[] = MemoryTest::createUserObject($clca_type);
        }

        return ["DEVICE_".$device_id => $users_list];
    }


    static function buildStructure(int $num_clcas, int $num_devices, int $num_users) {
        $structure = [];
        $clcs_ids = [1704111, 1704112, 1704113, 1704115, 1704116, 1704118, 1704120] ;
        // For each clca_id
        for ($i = 0; $i < $num_clcas; $i++) {

            $clca_id = 'CALC_' . $clcs_ids[array_rand($clcs_ids)];
            $clca_type = $i % 2 == 0 ? 'type1' : 'type2';

            if (!isset($structure[$clca_id])) {
                $structure[$clca_id] = [];
            }

            // For each device under this clca_id
            for ($j = 0; $j < $num_devices; $j++) {
                $device_object = MemoryTest::createDeviceObject($clca_type, $num_users);

                // Add device and its users to clca_id
                $structure[$clca_id] = array_merge($structure[$clca_id], $device_object);
            }
        }

        return $structure;
    }

    static function loadObjects(int $num_clcas, int $num_devices) {
        $clcaList = [];
        $clca_ids = [1704111, 1704112, 1704113, 1704115, 1704116, 1704118, 1704120] ;

        for ($i = 0; $i < $num_clcas; $i++) {
            $clca_id = $clca_ids[array_rand($clca_ids)];

            $clca_type = $i % 2 == 0 ? 'type1' : 'type2'; // Alternate clca types

            if (!isset($clcaList[$clca_id])) {
                $clcaList[$clca_id] = [
                    'clca_type' => $clca_type,
                    'devices' => []
                ];
            }

            // Add devices under this clca_id based on clca_type
            for ($j = 0; $j < $num_devices; $j++) {
                $device = MemoryTest::createDeviceObject($clca_type);
                $clcaList[$clca_id]['devices'][] = $device;
            }
        }

        return $clcaList;
    }


    static function createObject() {
        $ids = [1704111, 1704112, 1704113, 1704115, 1704116, 1704118 , 1704120];
        return (object)[
            'id' => $ids[array_rand($ids)],
            'name' => 'Device_' . rand(1, 1000),
            'status' => rand(0, 1),
            'duration' => rand(10, 120),
            'timestamp' => time(),
            'condition' => "duration > ".rand(200, 1000),
        ];
    }


    static function getCalcId(string $topic) : STRING {
        return (STRING) "CALC_".explode("/" , $topic)[4] ;
    }

    static function getDeviceId(string $topic) : string {
        return (string) "DEVICE_".explode("/" , $topic)[6] ;
    }


    static function findObjectsById($objects, $calcID , $deviceID) {
        echo "Looking for Calc ID: {$calcID}, Device ID: {$deviceID} 🔍\n";
        return $objects[$calcID][$deviceID] ?? null;
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