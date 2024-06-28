<?php

namespace Fdvice\channel\manage;
use Fdvice\channel\manage\ChannelDto ;


interface ChannelInterface {
    function createChannel($in_data , $credentials):array;
    function getChannelinfo($dataQuery , $credentials):array;
    function getChannelinfoUsingDevice(ChannelDto $device ,$credentials , $loadPath) ;
}