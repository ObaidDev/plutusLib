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

    /**
     * we use ndjson insteead of json :
     * check this url to see why: https://www.shubhsblog.com/2023/05/json-vs-ndjson-choosing-right-format.html
     */

    function addChannelNdjson($channelJson) {


        $pathChannelCach =  $GLOBALS["channel-ndjson-path"] ;


        $dirPath = dirname($pathChannelCach);

        // Check if the directory exists
        if (!is_dir($dirPath)) {
            // Attempt to create the directory recursively
            if (!mkdir($dirPath, 0777, true)) {
                die('Failed to create directories...');
            }
        }

        // Check if the file has been opened successfully
        if (file_put_contents($pathChannelCach, $channelJson . PHP_EOL, FILE_APPEND) === false) {
            throw new \Exception('Failed to write data to file...');
        }

        

        // return $res ;
    }

    function deleteChannelNdjson($id) {
        $id = (int)$id ;
        $pathChannelCach = $GLOBALS["channel-ndjson-path"];
        $tempFilePath = $pathChannelCach . '.tmp';

        // Open the input file for reading
        $inputFileHandle = fopen($pathChannelCach, 'r');
        if (!$inputFileHandle) {
            throw new \Exception("Could not open the file!");
        }

        // Open a temporary file for writing
        $tempFileHandle = fopen($tempFilePath, 'w');
        if (!$tempFileHandle) {
            fclose($inputFileHandle);
            throw new \Exception("Could not create a temporary file!");
        }

        // Track if the object was found and modified
        $found = false;
        $buffer = '';

        // Loop through each line in the file
        while (($line = fgets($inputFileHandle)) !== false) {
            $object = json_decode($line, true);

            if ($object && $object["id"] === $id) {
                $object["deleted"] = true;
                $found = true;
            }

            // Add the object to the buffer
            $buffer .= json_encode($object) . "\n";

            // Write the buffer to the file if it's large enough
            if (strlen($buffer) > 8192) { // Adjust buffer size as needed
                fwrite($tempFileHandle, $buffer);
                $buffer = ''; // Clear the buffer
            }
        }

        // Write any remaining data in the buffer
        if (!empty($buffer)) {
            fwrite($tempFileHandle, $buffer);
        }

        // Close the file handles
        fclose($inputFileHandle);
        fclose($tempFileHandle);

        if ($found) {
            // Replace the original file with the temporary file
            rename($tempFilePath, $pathChannelCach);
        } else {
            // If the object wasn't found, delete the temporary file
            unlink($tempFilePath);
            throw new \Exception("ID not found in the file!");
        }
        
    }

    function getChannelinfoUsingDeiceNdjson(ChannelDto $channeldto):array{

        $pathChannelCach = $GLOBALS["channel-ndjson-path"];

        $inputFileHandle = fopen($pathChannelCach, 'r');

        while (($line = fgets($inputFileHandle)) !== false) {
            $object = json_decode($line, true);

            if ($object["deleted"] == false && $object["protocol_id"] === $channeldto->getProtocol_id()) {
                // $found = true;
                fclose($inputFileHandle);
                return $object ;
            }
        }

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
