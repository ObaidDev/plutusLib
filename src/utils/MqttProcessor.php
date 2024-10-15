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
	private $objectList;
	private static $expressionLanguage ;


	public function __construct(int $num_records)
	{
		$startMemory = memory_get_usage();
		$this->objectList = MemoryTest::loadObjects($num_records);
		self::$expressionLanguage = new ExpressionLanguage() ;

		// var_dump(json_encode($this->objectList)) ;
		// die() ;
		$endMemory = memory_get_usage();

		$memoryUsed = $endMemory - $startMemory;
		echo "Memory used by {$num_records} objects: " . ($memoryUsed / 1024) . " KB\n";
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

	private static function expressionLanguageEvaluate($condition, $context) {
		return self::$expressionLanguage->evaluate($condition, $context) ;
	}



	function startup($topics)
	{

		$this->prepareConnection();
		$this->subscribe($topics);

		while ($this->mqtt->proc()) {
			usleep(10000);
		}

		$this->mqtt->close();
	}

	function processMessage($topic, $msg)
	{
		$startMemory = memory_get_usage();

		echo 'Msg Recieved: ' . date('r') . "\n";
		echo "Topic: {$topic}\n\n";
		echo "Mesage 🔖🔖🔖🔖: {$msg}\n\n";

		/**
		 * 
		 * @ Start Process Block
		 * we will index the device_id and calc_id to seepd up the query serching
		 */

		$vars = MemoryTest::findObjectsById($this->objectList, MemoryTest::getCalcId($topic));
		
		foreach ($vars as $object) {
			# code...
			if (
				$object != null &&
				MqttProcessor::expressionLanguageEvaluate($object->condition , json_decode($msg, true))
				
			) {
				# code...
				echo ("Send✅✅✅✅\n\n");
			};
		}


		$endMemory = memory_get_usage();
		$memoryUsed = $endMemory - $startMemory;
		echo "Memory used at the end: " . ($memoryUsed / 1024) . " KB\n";

		/**
		 * 
		 * @ End Process Block
		 */
	}
}
