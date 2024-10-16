<?php
namespace Fdvice\device;


use Fdvice\channel\manage\Channel;
use Fdvice\channel\manage\ChannelInterface;
use Fdvice\CurlHelper;
use Fdvice\device\settings\SettingInterface;
use Fdvice\device\settings\Setting ;
use Fdvice\device\manage\DeviceInterface;
use Fdvice\device\manage\Device;
use Fdvice\device\manage\DeviceDto;

use Fdvice\device\calcs\RestCalcsInterface ;
use Fdvice\device\calcs\RestCalcs ;
use Fdvice\device\calcs\SelectorsInterface ;

// require_once base_path()."/config/config-flespi.php" ;
// require_once "./config/config-exemple.php" ;








class FacadeDevice {

    private static DeviceInterface $device;
    // private SettingInterface $settings;
    private static ChannelInterface $channel ;
    private static RestCalcsInterface $dirctlyRestCalcs ;

    function __construct()
    {
        self::$device =  new Device() ;
        // $this->settings =  new Setting() ;
        self::$channel = new Channel();
        self::$dirctlyRestCalcs = new RestCalcs();
    }
    public function setDevice($device){
        self::$device = $device;

    }
    function getDevice() : DeviceInterface {

        return self::$device;
    }

    function addDevice($device, $Usertoken):array{
        // $res = self::$device->addDevice($device , $GLOBALS["Token"]) ;
        $res = self::$device->addDevice($device , $Usertoken) ;
        return $res ;
    }

    function getDeviceinfo(DeviceDto $deviceDto, $userToken) {
        return self::$device->getDeviceinfo($deviceDto , $userToken) ;
    }

    function deleteDevice($selector, $usertoken)  {
        $res = self::$device->deleteDevice($selector , $usertoken);
        return $res ;
    }

    function updateDevice($deviceData, $Usertoken):array {
        $res = self::$device->updateDevice($deviceData , $Usertoken) ;
        return $res ;
    }

    // get the device type and names and other things .
    function saveDevicesData() : void {

        // if you want to change the fileds that return by or somthing you can change it from here ;
        $jsonString = '{"channel-protocols.selector":[],"devtypes":[],"fields":["protocol_name","id","protocol_id","name","title"]}';
        $data_Query = json_decode($jsonString , true) ;

        $res = self::$device->getListDevices($data_Query , $GLOBALS["Token"]) ;

        $path = $GLOBALS['device-data-path'] ;

        // $ this code is from saving the data in json file
        // @ you can change the path of this file by editing the device-data-path
        // in config-flespi.php

        $jsonData = json_encode($res, JSON_PRETTY_PRINT);
            // Extract the directory path
            $dirPath = dirname($path);

            // Check if the directory exists
            if (!is_dir($dirPath)) {
                // Attempt to create the directory recursively
                if (!mkdir($dirPath, 0777, true)) {
                    die('Failed to create directories...');
                }
            }

            // Open the file for writing
            $fp = fopen($path, 'w');

            // Check if the file has been opened successfully
            if ($fp === false) {
                die('Failed to open the file for writing...');
            }

            // Write the JSON string to the file
            fwrite($fp, $jsonData);

            // Close the file
            fclose($fp);
        // return $res ;
    }


    // move a divece to thiere owner .
    function moveDeivceToAccounte(DeviceDto $device , $userToken):array{
        $res = self::$device->moveDeivceToSubaccounte($device->getCid() , $device->getIds(), $userToken) ;
        return $res ;
    }


    function dirctlyExcuteReport (DeviceDto $deviceDto , SelectorsInterface $selector , $userToken) : array {
        return self::$dirctlyRestCalcs->dirctlyExcuteReport($deviceDto , $selector ,$userToken) ;
    }

    // settings

    function getSettings(DeviceDto $deviceDto , $userToken) : array {

        return self::$device->getSettings($deviceDto , $userToken) ;
        
    }


    function getDevicesTelemetry(DeviceDto $deviceDto, $userToken) : array {
        
        return  self::$device->getDevicesTelemetry($deviceDto , $userToken) ;
        
    }

    function getDevicesMessages(DeviceDto $deviceDto, $userToken) : array {
        
        return  self::$device->getDevicesMessages($deviceDto , $userToken) ;
        
    }

    function addDevices($devices  , $fields, $credentials):array{
        
        return self::$device->addDevices($devices  , $fields, $credentials) ;

    }
}
