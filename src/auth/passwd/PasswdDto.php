<?php

namespace Fdvice\auth\passwd ;



class PasswdDto {
    // private $registration;
    private string $key;

    public function __construct($key) {
        $this->key = $key;
    }

    public function getKey() {
        return $this->key;
    }

    public function setKey($key) {
        $this->key = $key;
    }



    public function __invoke(){
        $data = [
            'password' => $this->getKey(),
            'confirmation' => $this->getKey()
        ];

        return $data ;
    }

    public function token() : Returntype {
        
    }
}

?>
