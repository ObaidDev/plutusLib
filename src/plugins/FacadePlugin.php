<?php


namespace Fdvice\plugins ;

use Fdvice\plugins\manage\Plugin;
use Fdvice\plugins\manage\PluginDto;
use Fdvice\plugins\manage\PluginInterface;


use Fdvice\plugins\devices\AssignDeviceInterface ;
use Fdvice\plugins\devices\AssignDevice ;

use Fdvice\device\manage\DeviceDto ;

final class FacadePlugin
{

    private static PluginInterface $plugin;
    private static AssignDeviceInterface $assign;

    function __construct()
    {
        self::$plugin =  new Plugin() ;
        self::$assign =  new AssignDevice() ;
    }


    function addPlugin(PluginDto $pluginDto , $userToken) {
        $res = self::$plugin->addPlugin($pluginDto , $userToken) ;
        return $res ;
    }


    function addPlugins($userToken) {
        {
            // $reportesRes = self::$caluctor->addCalculators(json_decode($jsonString, true) , $key) ;

            //* convert data form json to object of Plugin Dto . 
            $plugins = array_map(function ($plugin) {
                $plutginDto = PluginDto::create($plugin["name"] ,
                                                $plugin["item_type"] , 
                                                $plugin["type_id"],
                                                $plugin["configuration"]
                                            ) ;
                return  $plutginDto;

            } , json_decode(file_get_contents(__DIR__."/../../config/plugins.json") , true)) ;
        } 

        // var_dump($data) ;
        $res = self::$plugin->addPlugins($plugins , $userToken) ;
        return $res ;

        
    }
    

    function assignDevice(PluginDto $pluginDto , DeviceDto $deviceDto,$userToken) : array {
        $res = self::$assign->assignDevice($pluginDto ,$deviceDto,$userToken) ;
        return $res ;
    }

    function unAssignDevice(PluginDto $pluginDto , DeviceDto $deviceDto,$userToken) : array {
        $res = self::$assign->unAssignDevice($pluginDto ,$deviceDto,$userToken) ;
        return $res ;
    }


    function getPlugins(PluginDto $pluginsDto ,$userToken) : array {
        
        $res = self::$plugin->getPlugins($pluginsDto ,$userToken) ;
        return $res ;
    }


    function assignDevices(DeviceDto $deviceDto,$userToken) : array {
        return self::$assign->assignDevices($deviceDto,$userToken) ;
    }
}
