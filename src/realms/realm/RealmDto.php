<?php

namespace Fdvice\realms\realm;

use Fdvice\tokens\token\TokenDto ;

class RealmDto {
    private $homeType;
    private $name;
    private TokenDto $token;


    public function __construct($name ,$homeType, TokenDto $token) {
        $this->homeType = $homeType;
        $this->name = $name;
        $this->token = $token;
    }


    public function getHomeType() {
        return $this->homeType;
    }

    public function setHomeType($homeType) {
        $this->homeType = $homeType;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function __invoke() {
        return [
            'home' =>["type"=> $this->gethomeType()],
            'name' => $this->getName(),
            'token_params' => $this->getToken()()
        ];
    }
}

?>
