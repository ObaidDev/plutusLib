<?php

namespace Fdvice\device\manage ;




interface DeviceInterface {

    function addDevice($device , $credentials):array;
    function getDeviceinfo(DeviceDto $dataQuery , $credentials):array;
    function deleteDevice(DeviceDto $in_data , $credentials):array;
    function updateDevice($in_data , $selector , $credentials):array;
    function moveDeivceToSubaccounte($in_data , $selector , $credentials):array;

    // this function will return all device info like protcol id , id and name of the device.
    // aslo if you want to Get collection of device types withing specified channel protocols.
    function getListDevices($data_Query , $credentials):array;
}