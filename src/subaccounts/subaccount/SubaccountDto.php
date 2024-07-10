<?php

namespace Fdvice\subaccounts\subaccount ;

// use Fdvice\auth\passwd\PasswdDto ;


class SubaccountDto {
    // private $registration;
    private $name;
    private $limit_id;
    private $enabled = true;
    // private Tok$tokenParams;
    // private $realmId;
    private string $email ;
    // private PasswdDto $passwd ;
    private string $passwd ;
    private $ids ;

    public function __construct() {
        // $this->name = $name;
        // $this->email = $email;
        // $this->passwd = $passwd;
        // $this->limit_id = $limit_id;
    }

    static function create($name , $passwd , $email){
        $subaccountObject = new self() ;
        $subaccountObject->setName($name);
        $subaccountObject->setPasswd($passwd);
        $subaccountObject->setEmail($email);

        return $subaccountObject ;
    }

    static function loginEmailPasswd($passwd , $email){
        $subaccountObject = new self() ;
        $subaccountObject->setPasswd($passwd);
        $subaccountObject->setEmail($email);

        return $subaccountObject ;
    }

    static function loginPasswdLess($email){
        $subaccountObject = new self() ;
        $subaccountObject->setEmail($email);

        return $subaccountObject ;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPasswd() {
        return $this->passwd;
    }

    public function setPasswd($passwd) {
        $this->passwd = $passwd;
    }

    public function getLimitId() {
        return $this->limit_id;
    }

    public function setLimitID($limit_id) {
        $this->limit_id = $limit_id;
    }

    // realm id
    public function getEnabled() {
        return $this->enabled;
    }

    public function setEnabled($enabled) {
        $this->enabled = $enabled;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getIds() {
        return $this->ids;
    }

    public function setIds($ids) {
        $this->ids = $ids;
    }



    public function __invoke(){
        $data = [
            'name' => $this->getName(),
            // 'limit_id' => $this->getLimitID(),
            'enabled' => $this->getEnabled()
        ];

        ($this->getLimitID() != null) ? $data["limit_id"]=$this->getLimitID():$data ;
        return $data ;
    }


    public function loginEmailPasswdData() : array {
        $data = [
            'email' => $this->getEmail(),
            'password' => $this->getPasswd()
        ];

        return $data ;
    }

    public function loginPasswdLessData() : array {
        $data = [
            'email' => $this->getEmail()
        ];

        return $data ;
    }

    // public function token() : Returntype {
        
    // }
}

?>
