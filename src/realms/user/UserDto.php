<?php

namespace Fdvice\realms\user ;

use Fdvice\tokens\token\TokenDto ;


class UserDto {
    private $registration="immediate";
    private $name;
    private $password;
    private $metadata;
    private ?TokenDto $token = null;
    private $realmId;
    private $realmPublicId;
    private $ids ;

    public function __construct() {
    }

    static function create($name, $password, $realmId) : UserDto {
        $userDto = new UserDto() ;
        $userDto->setName($name) ;
        $userDto->setPassword($password) ;
        $userDto->setRealmId($realmId) ;

        return $userDto ;
    }

    static function login($name, $password , $realmPublicId) : UserDto {
        $userDto = new UserDto() ;
        $userDto->setName($name) ;
        $userDto->setPassword($password) ;
        $userDto->setRealmPublicId($realmPublicId) ;

        return $userDto ;
    }

    public function getRegistration() {
        return $this->registration;
    }

    public function setRegistration($registration) {
        $this->registration = $registration;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    // realm id
    public function getRealmId() {
        return $this->realmId;
    }

    public function setRealmId($realmId) {
        $this->realmId = $realmId;
        return $this ;
    }

    public function getRealmPublicId() {
        return $this->realmPublicId;
    }

    public function setRealmPublicId($realmPublicId) {
        $this->realmPublicId = $realmPublicId;
    }

    public function getMetadata() {
        return $this->metadata;
    }

    public function setMetadata($metadata) {
        $this->metadata = $metadata;
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken(TokenDto $token) {
        $this->token = $token ;
    }

    /**
     * @
     */
    public function getIds() {
        return $this->ids;
    }

    public function setIds($ids) {
        $this->ids = $ids;
        return $this ;
    }

    public function __invoke() {
        $data = [
            'registration' => $this->getRegistration(),
            'name' => $this->getName(),
            'password' => $this->getPassword()
        ];

        ($this->getToken() != null) ? $data["token_params"]=$this->getToken()():$data ;
        ($this->getMetadata() != null) ? $data["metadata"]=$this->getMetadata():$data ;

        return $data ;

        
    }

    public function loginData() {
        $data = [
            'name' => $this->getName(),
            'password' => $this->getPassword()
        ];
        return $data ;

        
    }
}

?>
