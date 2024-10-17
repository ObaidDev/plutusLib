<?php

namespace Fdvice\plugins\devices ;

use Fdvice\device\manage\DeviceDto;

use Fdvice\plugins\manage\PluginDto ;

interface AssignDeviceInterface {

    function assignDevice(PluginDto $pluginDto , DeviceDto $deviceDto,$userToken) : array ;
    function unAssignDevice(PluginDto $pluginDto , DeviceDto $deviceDto,$userToken) : array ;
    function assignDevices(DeviceDto $deviceDto,$userToken) : array ;

}