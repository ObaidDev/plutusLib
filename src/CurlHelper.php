<?php
namespace Fdvice;

use Fdvice\exception\DataNotFoundException;
use Fdvice\handlers\base\BaseHandler;
use Fdvice\handlers\customize\TokenExpired;
use Fdvice\handlers\customize\ErrorMiddleware ;




final class CurlHelper
{
    private static BaseHandler $handler ;

    static function excuteCurl($curl) : array {

        
        /**
         * here we init the Chaine of the handlers for like the 
         * the ErrorMiddleware where we generate the Exceptions .
         * we can add what ever we want of the handlers like 
         * handler for errors and other for caching some specifc 
         * errors and do somthing . 
         * @link ErrorMiddleware()
         * 
        */

        
        {
            self::$handler = new ErrorMiddleware() ;
            $h1 = new TokenExpired() ;

            self::$handler->setNext($h1) ;
        }


        $response = curl_exec($curl);
        // $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $response = json_decode($response , JSON_PRETTY_PRINT) ;
        $err = curl_error($curl);
        curl_close($curl);
        
        // !we handel the and generate the Exception form here .
        
        /**
        * 
        * give the handler the response so can proccess it 
        */
        self::$handler->handle($response) ;

        return $response ;
    }


    static function post($url,$in_data , $credentials)  {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($in_data, JSON_PRETTY_PRINT),
            CURLOPT_HTTPHEADER => [
                "Authorization: ".$credentials,
                "Content-Type: application/json" ,
                "Accept: */*"
            ],
        ]);

        return $curl ;
    }

    static function post_with_additional_header($url,$in_data , 
     $additional_headers , $credentials)  {
        $curl = curl_init();

        $default_headers = [
            "Authorization: " . $credentials,
            "Content-Type: application/json",
            "Accept: */*" ,
            
        ];

        {
            if ($additional_headers != null) {
                $headers = array_merge($default_headers, $additional_headers);
                // var_dump($headers) ;
            }
            else {
                $headers = $default_headers ;

            }
        }
        
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($in_data, JSON_PRETTY_PRINT),
            CURLOPT_HTTPHEADER => $headers ,
            // CURLOPT_VERBOSE => true,  // Enable verbose output
            // CURLOPT_STDERR => $verbose // Redirect verbose output to the specified stream
        ]);

        curl_close($curl);
        // fclose($verbose);
    
        return $curl; // Returning the response instead of the cURL handle
    }


    static function get($url , $credentials) {
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: ".$credentials,
                "Accept: */*"
            ],
        ]);

        return $curl ;
    }

    static function delete($url , $credentials) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_HTTPHEADER => [
                "Authorization: ".$credentials,
                "Content-Type: application/json" ,
                "Accept: */*"
            ],
        ]);

        return $curl ;
    }


    static function put($url , $in_data , $credentials)  {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => json_encode($in_data, JSON_PRETTY_PRINT),
            CURLOPT_HTTPHEADER => [
                "Authorization: ".$credentials,
                "Content-Type: application/json" ,
                "Accept: */*"
            ],
        ]);

        return $curl ;
    }

    static function putAdditionalHeader($url , $in_data , $additional_headers ,$credentials)  {
        $curl = curl_init();

        $default_headers = [
            "Authorization: " . $credentials,
            "Content-Type: application/json",
            "Accept: */*" ,
            
        ];

        {
            if ($additional_headers != null) {
                $headers = array_merge($default_headers, $additional_headers);
                // var_dump($headers) ;
            }
            else {
                $headers = $default_headers ;

            }
        }

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => json_encode($in_data, JSON_PRETTY_PRINT),
            CURLOPT_HTTPHEADER => $headers ,
        ]);

        return $curl ;
    }

    static function loadDataJson($path) :array {
        $jsonString = file_get_contents($path);

        // Decode JSON string into PHP array
        $data = json_decode($jsonString, true);

        // Check if decoding was successful
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            die('Error decoding JSON file');
        }

        return $data ;
    }



    static function getEndpointUrl($endpointsFilePath , $name) {

        // Read the JSON file into a string
        $jsonString = file_get_contents($endpointsFilePath);
        // decode the json to php array
        $jsonArray = json_decode($jsonString, true);

        $endpoints = $jsonArray[0]['endpoints'];

        foreach ($endpoints as $endpoint) {
            if ($endpoint['name'] === $name) {
                return $endpoint["url"];
            }
        }
        return null;
    }

    static function time_to_minutes($hour, $minute) {

        return $hour * 60 + $minute;
    }


    static function handle_wraparound($R_start, $R_end) {
        // Adjust R_end if it is less than R_start
        if ($R_end == 0) {
            $R_end = 1440; // Adjust 00:00 to 24:00
        } elseif ($R_end < $R_start) {
            $R_end += 1440; // Add 24 hours in minutes to R_end
        }
        return [$R_start, $R_end];
    }

    static function is_trip_overlapping_range($T_start, $T_end, $R_start, $R_end) {
        // Handle wraparound for the range
        list($R_start, $R_end) = CurlHelper::handle_wraparound($R_start, $R_end);
        
        // Handle wraparound for the trip times
        if ($T_end < $T_start) {
            $T_end += 1440; // Add 24 hours in minutes to T_end
        }
    
        // Check for overlap
        return ($T_start < $R_end && $T_end > $R_start);
    }
    
}
