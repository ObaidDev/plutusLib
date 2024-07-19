<?php

namespace Fdvice\channel;
use Fdvice\channel\manage\Channel ;
use Fdvice\channel\manage\ChannelInterface ;
use Fdvice\channel\manage\ChannelDto ;

require_once base_path()."/config/config-flespi.php" ;
// require_once __DIR__."../../../config/config-exemple.php" ;



class FacadeChannel
{
    private static ChannelInterface $channel ;

    function __construct (){
        self::$channel = new Channel() ;
    }

    // this method use the global token
    function createChannel($in_data , $userToken) : array {
        $res = self::$channel->createChannel($in_data , $userToken);
        $dataQuery = ["ch-selector"=>[] , "fields"=> []] ;

        // $pathChannelCach = $GLOBALS["channel-data-path"] ;
        $this->saveChannelsData($userToken);
        return $res ;
    }

    function saveChannelsData($userToken) {


        $jsonString = '{"ch-selector": [],"fields": []}';
        $dataQuery = json_decode($jsonString , true) ;

        $res = self::$channel->getChannelinfo($dataQuery , $userToken);

        $pathChannelCach =  $GLOBALS["channel-data-path"] ;


        // $ this code is for saving the data in json file
        // @ you can change the path of this file by editing the channel-data-path
        // in config-flespi.php

        $jsonData = json_encode($res, JSON_PRETTY_PRINT);
            // Extract the directory path
            $dirPath = dirname($pathChannelCach);

            // Check if the directory exists
            if (!is_dir($dirPath)) {
                // Attempt to create the directory recursively
                if (!mkdir($dirPath, 0777, true)) {
                    die('Failed to create directories...');
                }
            }

            // Open the file for writing
            $fp = fopen($pathChannelCach, 'w');

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


    function getChannelinfoUsingDeice(ChannelDto $channeldto , $userToken):array{

        $response = self::$channel->getChannelinfoUsingDevice($channeldto  , $userToken , $GLOBALS["channel-data-path"]) ;
        if ($response != null) {
            return $response ;
        }
        else {
            // $data = [["name"=>$channeldto->getName()."-channel-".date("Y-m-d") ,
            // "protocol_id"=>$channeldto->getProtocol_id()]];
            // $response = $this->createChannel($data,$userToken) ;
            $this->saveChannelsData($userToken);
            $response = self::$channel->getChannelinfoUsingDevice($channeldto  , $userToken , $GLOBALS["channel-data-path"]) ;
            
            // return $response["result"][0] ;
            return $response ;
        };

        // $response can be the target channel or the error .


    }
}
