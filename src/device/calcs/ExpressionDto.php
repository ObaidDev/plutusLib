<?php

namespace Fdvice\device\calcs ;

final class ExpressionDto implements SelectorsInterface
{
    

    private ?string $expression ;
    private string $type = "expression" ;
    private $from = null;
    private $to =null;
    private $filter = null ;
    private $counters = [
        [
            "method"=> "first",
            "name"=> "device_id",
            "parameter"=> "device.id",
            "type"=> "parameter"

        ],
        [
            "expression"=>"position.speed",
            "name"=>"max_speed",
            "type"=>"expression",
            "method"=>"maximum"
        ],
        [
            "expression"=>"position.speed",
            "name"=>"avg_speed",
            "type"=>"expression",
            "method"=>"average"
        ],
        [
            "expression"=> "mileage()",
            "method"=> "summary",
            "name"=> "distance",
            "type"=> "expression"
        ],
        [
            "method"=> "last",
            "name"=> "last_address",
            "parameter"=> "wialon.address",
            "type"=> "parameter"
        ],
        [
            "method"=> "first",
            "name"=> "start_address",
            "parameter"=> "wialon.address",
            "type"=> "parameter"
        ]
    ] ;

    private $min_duration = 1 ;


    private function __construct() {
         //add ad defalute date
        $this->from = strtotime(date('Y-m-d', strtotime('-1 day')));
        $this->to = strtotime(date('Y-m-d'));
    }

    
    static function emptyConstruct(){
        return (new ExpressionDto());
    }
    
    static function create($expression , $from , $to , $min_duration){
        $expressionDto = new ExpressionDto();
        $expressionDto->setExpression($expression) ;
        $from != null ? $expressionDto->setFrom($from) : "nothing" ;
        $to != null ? $expressionDto->setTo($to) : "nothing" ;
        $min_duration != null ? $expressionDto->setMin_duration($min_duration) : "nothing" ;
        return $expressionDto;
    }


    public function getExpression(): ?string
    {
        return $this->expression;
    }

    // Setter for expression
    public function setExpression(?string $expression): void
    {
        $this->expression = $expression;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from): void
    {
        $this->from = $from;
    }

    public function getMin_duration()
    {
        return $this->min_duration;
    }

    public function setMin_duration($min_duration): void
    {
        $this->min_duration = $min_duration;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to): void
    {
        $this->to = $to;
    }

    public function getFilter(): ?string
    {
        return $this->filter;
    }

    public function setFilter($filter): void
    {
        $this->filter = $filter;
    }

    public function getCounters()
    {
        return $this->counters;
    }

    public function setCounters($counter): void
    {
        array_push($this->counters , $counter) ;
    }



    public function _create() : array {
        
        $data = [
            "expression"=>$this->getExpression() ,
            "type"=>$this->getType() ,
            "min_duration"=>$this->getMin_duration(),
            // "counters"=>$this->getCounters(),
            // "validate_message"=>$this->validate_message,
            // "item_type"=>$this->getItemType(),
            // "name"=>$this->getName(),
            // "configuration"=>($this->getConfiguration() != null ? $this->getConfiguration() : new \stdClass),
            // "priority"=>$this->getPriority() ,
            // "type_id"=>$this->getTypeId() ,
            // "timezone"=>$this->getTimezone()

        ];
        // $data = array_merge($data , ["counters"=>$this->getCounters()]) ;

        return $data ;
    }


}
