<?php


namespace Fdvice\device\calcs ;
use Fdvice\device\manage\DeviceDto ;

interface RestCalcsInterface {
    
    function dirctlyExcuteReport(DeviceDto $deviceDto , SelectorsInterface $selector , $userToken) : array ;


}