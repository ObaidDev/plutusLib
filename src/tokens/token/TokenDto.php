<?php

namespace Fdvice\tokens\token ;



class TokenDto {
    // private $registration;
    private $type;
    private $acl=null;
    private $enabled = true;
    private string $info="" ;
    private int $ttl=31536000;
    // private $tokenParams;
    // private $realmId;
    private $tokenId ;
    private $ownerId ;

    public function __construct($type) {
        $this->type = $type;
        // $this->info = $info;

        
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    // info 
    public function getInfo() {
        return $this->info;
    }

    public function setInfo($info) {
        $this->info = $info;
    }

    // ttl
    public function getTtl() {
        return $this->ttl;
    }

    public function setTtl($ttl) {
        $this->ttl = $ttl;
    }
    


    public function getEnabled() {
        return $this->enabled;
    }

    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }

    public function getAcl() {
        return $this->acl;
    }

    public function setAcl($acl) {
        $this->acl = $acl;
    }

    public function getOwnerId() {
        return $this->ownerId;
    }

    public function setOwnerId($ownerId) {
        $this->ownerId = $ownerId;
    }

    public function getTokenId() {
        return $this->tokenId;
    }

    public function setTokenId($tokenId) {
        $this->tokenId = $tokenId;
    }


    public function __invoke(){
        $data = [
            "ttl"=>$this->getTtl() ,
            "access"=>[
                "type"=>$this->gettype(),
            ]
        ];
        ($this->getAcl() != null)? $data["access"]["acl"]=$this->getAcl():null;
        ($this->getInfo() != null)? $data["info"]=$this->getInfo():null;
        // $data[0]["access"]["type"] = $this->gettype() ;
        

        return $data ;
    }

    
}

