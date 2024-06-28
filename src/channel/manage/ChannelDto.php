<?php

namespace Fdvice\channel\manage;



class ChannelDto {

    private ?int $protocol_id ; 
    private string $name;
    private $configuration = null;
    private bool $enabled = true;
    private ?int $cid = null ;

    public function __construct() {
        // $this->name = $name;
        // $this->protocol_id = $protocol_id;
        // $this->device_type_id = $device_type_id;
    }

    static function search($name , $protocol_id) :  ChannelDto{

        $channel = new ChannelDto() ;
        $channel->setName($name) ;
        $channel->setProtocol_id($protocol_id) ;

        return $channel ;
        
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    
    function getProtocol_id() { 
        return $this->protocol_id; 
    } 
    
    function setProtocol_id($protocol_id) {  
        $this->protocol_id = $protocol_id; 
    } 
    function getConfiguration() { 
        return $this->configuration; 
    } 
    
    function setConfiguration($configuration) {  
        $this->configuration = $configuration; 
    }
    
    function getCid() { 
        return $this->cid; 
    } 
    
    function setCid($cid) {  
        $this->cid = $cid; 
    } 


    public function __invoke() {
        $data = [
            'configuration' => [
                "ident"=>$this->getIdent()
            ],
            'device_type_id' => $this->getDevice_type_id(),
            'name' => $this->getName()
        ];
    
        ($this->getPhone() != null) ? $data["configuration"]["phone"]=$this->getPhone():null ;
        ($this->getMessages_ttl() != null) ? $data["messages_ttl"]=$this->getMessages_ttl():null ;
        ($this->getMedia_ttl() != null) ? $data["media_ttl"]=$this->getMedia_ttl():null ;
    
        return $data ;
    
        // var_dump($data) ;
    
        
    }
}
