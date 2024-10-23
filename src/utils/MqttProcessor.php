<?php

namespace Fdvice\utils;

use Bluerhinos\phpMQTT;
use Fdvice\utils\MemoryTest;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage ;



class MqttProcessor
{
	private $server = 'mqtt.flespi.io';
	private $port = 1883;
	private $username = 'CaaFWLmqLlaXX4tM9B7C9LkGmEgE6EPAoY03SukImT0ksgNE5gBIjSmXcgM0sjhe';                   // set your username
	private $password = '';
	private $client_id = 'phpMQTT-subscriber';

	private $mqtt;

	private $memoryLoader;
	protected $objectList;
	private static $expressionLanguage ;


	public function __construct(array $notificationsObjects)
	{
		// $startMemory = memory_get_usage();
		// $this->objectList = MemoryTest::buildStructure($num_clcas , $num_devices , $num_users);

		$this->objectList = $notificationsObjects ;
		self::$expressionLanguage = new ExpressionLanguage() ;

		// var_dump($this->objectList) ;

		// $endMemory = memory_get_usage();
		// $memoryUsed = $endMemory - $startMemory;
		// echo "Memory used by {$num_clcas} clcs and {$num_devices} devices: " . ($memoryUsed / 1024) . " KB\n";
		// die() ;
	}

	private  function prepareConnection()
	{
		$this->mqtt = new phpMQTT($this->server, $this->port, $this->client_id);
		if (!$this->mqtt->connect(true, NULL, $this->username, $this->password)) {
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

		// var_dump($this->objectList) ;
		// die() ;
		// $startMemory = memory_get_usage();

		$maxMessageSize = 1024 * 1024; // 1 MB (adjust as necessary)
		// $maxMessageSize = 64; // 64 bytes for testing
		if (strlen($msg) > $maxMessageSize) {
			echo "Message too large, skipping: {$topic}\n";
			return;
		}


		// echo 'Msg Recieved: ' . date('r') . "\n";
		// echo "Topic: {$topic}\n\n";
		// echo "Mesage 🔖🔖🔖🔖: {$msg}\n\n";

		// /**
		//  *
		//  * @ Start Process Block
		//  * we will index the device_id and calc_id to seepd up the query serching
		//  */

		$target = MemoryTest::findObjectsById($this->objectList, MemoryTest::getCalcId($topic) , MemoryTest::getDeviceId($topic));

		// var_dump($target) ;
		// $vars = MemoryTest::findObjectsById($this->objectList, $calc_id);
		// die();

		$startTime = microtime(true);
		if ($target != null) {


			if ($target["isEmail"]) {
				var_dump("Send✅\n") ;
			}
			# code...
			// foreach ($users as $user) {

			// 	if (
			// 		$user != null &&
			// 		MqttProcessor::expressionLanguageEvaluate($user["condition"] , json_decode($msg, true))

			// 	) {
			// 		# code...
			// 		echo ("Send✅✅✅✅\n\n");
			// 	};
			// }
		}
		$endTime = microtime(true);
		$duration = $endTime - $startTime;
		echo "Task duration: " . ($duration * 1000) . " milliseconds 🔖🔖\n";


		// $endMemory = memory_get_usage();
		// $memoryUsed = $endMemory - $startMemory;
		// echo "Memory used at the end: " . ($memoryUsed / 1024) . " KB\n";

		// /**
		//  *
		//  * @ End Process Block
		//  */
	}


	public static function  prepareUserPreferenceMessage(string $template, array $values) : string {
		$placeholders = [];

		foreach ($values as $key => $value) {
			$placeholders["{" . $key . "}"] = $value;
		}
		return strtr($template, $placeholders);
	}
}
