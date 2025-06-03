<?php

namespace Fdvice\utils;

use Bluerhinos\phpMQTT;
use Fdvice\utils\MemoryTest;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage ;



class MqttProcessor
{
	protected $server = 'mqtt.flespi.io';
	protected $port = 1883;
	protected $username = 'CaaFWLmqLlaXX4tM9B7C9LkGmEgE6EPAoY03SukImT0ksgNE5gBIjSmXcgM0sjhe';                   // set your username
	protected $password = '';
	protected $client_id = 'phpMQTT-subscriber';

	protected $mqtt;

	private $memoryLoader;
	protected $objectList;
	private static $expressionLanguage ;


	public function __construct(array $notificationsObjects)
	{

		$this->objectList = $notificationsObjects ;
		self::$expressionLanguage = new ExpressionLanguage() ;


		self::$expressionLanguage->register(
            'hasAnyOf',
            // Compiler function (for compilation/caching)
            function ($geofences, $searchList) {
                return sprintf('(is_array(%1$s) && array_intersect(%1$s, %2$s))', $geofences, $searchList);
            },
            // Evaluator function (actual execution)
            function ($arguments, $geofences, $searchList) {
                if (!$geofences) return false;
                if (!is_array($geofences) || !is_array($searchList)) return false;
                
                foreach ($searchList as $item) {
                    if (in_array($item, $geofences)) {
                        return true;
                    }
                }
                return false;
            }
        );
        
        // Register notHasAnyOf function
        self::$expressionLanguage->register(
            'notHasAnyOf',
            // Compiler function
            function ($geofences, $searchList) {
                return sprintf('(!is_array(%1$s) || !array_intersect(%1$s, %2$s))', $geofences, $searchList);
            },
            // Evaluator function
            function ($arguments, $geofences, $searchList) {
                if (!$geofences) return true;
                if (!is_array($geofences) || !is_array($searchList)) return true;
                
                foreach ($searchList as $item) {
                    if (in_array($item, $geofences)) {
                        return false;
                    }
                }
                return true;
            }
        );

    	$this->client_id = $this->client_id ."_".time() ;

	}

	private  function prepareConnection()
	{
		$this->mqtt = new phpMQTT($this->getServer(), $this->getPort(), $this->getClientId());
		if (!$this->mqtt->connect(true, NULL, $this->getUsername(), $this->getPassword())) {
			exit(1);
		}

		$this->mqtt->debug = true;
	}

	private function subscribe($topics)
	{
		$this->mqtt->subscribe($topics, 0);
	}

	public static function expressionLanguageEvaluate($condition, $context) {
		return self::$expressionLanguage->evaluate($condition, $context) ;
	}



	function startup($topics)
	{

		$this->prepareConnection();
		$this->subscribe($topics);

		while ($this->mqtt->proc()) {
			// usleep(10000);
		}

		$this->mqtt->close();
	}

	function processMessage($topic, $msg)
	{


		$maxMessageSize = 1024 * 1024; // 1 MB (adjust as necessary)

		$genfanceName = json_decode($msg , true)["geofence_name"] ;
		var_dump($genfanceName == $genfanceName) ;
		$maxMessageSize = 64; // 64 bytes for testing
		if (strlen($msg) > $maxMessageSize) {
			echo "Message too large, skipping: {$topic}\n";
			echo "Message : " . $msg . " 🗽\n";
			return;
		}

		$target = MemoryTest::findObjectsById($this->objectList, MemoryTest::getCalcId($topic) , MemoryTest::getDeviceId($topic));


		$startTime = microtime(true);
		if ($target != null) {


			if ($target["isEmail"]) {
				var_dump("Send✅\n") ;
			}
		}
		$endTime = microtime(true);
		$duration = $endTime - $startTime;
		echo "Task duration: " . ($duration * 1000) . " milliseconds 🔖🔖\n";
	}


	public static function  prepareUserPreferenceMessage(string $template, array $values) : string {
		$placeholders = [];

		foreach ($values as $key => $value) {
			$placeholders["{" . $key . "}"] = $value;
		}
		return strtr($template, $placeholders);
	}

	// Getter for server
    public function getServer() {
        return $this->server;
    }

    // Setter for server
    public function setServer($server) {
        $this->server = $server;
    }

    // Getter for port
    public function getPort() {
        return $this->port;
    }

    // Setter for port
    public function setPort($port) {
        $this->port = $port;
    }

    // Getter for username
    public function getUsername() {
        return $this->username;
    }

    // Setter for username
    public function setUsername($username) {
        $this->username = $username;
    }

    // Getter for password
    public function getPassword() {
        return $this->password;
    }

    // Setter for password
    public function setPassword($password) {
        $this->password = $password;
    }

    // Getter for client_id
    public function getClientId() {
        return $this->client_id;
    }

    // Setter for client_id
    public function setClientId($client_id) {
        $this->client_id = $client_id;
    }
}
