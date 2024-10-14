<?php

namespace Fdvice\device\manage;



class DeviceDto {
    private ?string $name ;
    private ?string $ident = null;
    private ?string $settings_polling = null;
    private ?int $device_type_id;
    private ?int $messages_ttl = null;
    private ?int $media_ttl = null;
    private ?string $phone = null ;
    private  $ids  ;
    private  $calcs ;
    private $fields = null;
    private $selectors = null;
    private $enabled = null ;
    private $filter = null ;
    private ?int $from ;
    private ?int $to ;

    private array $metadata = [];

    private $cid  ;

    public function __construct($name, $ident, $device_type_id) {
        $this->name = $name;
        $this->ident = $ident;
        $this->device_type_id = $device_type_id;
    }

    static function emptyConstruct(){
        return (new DeviceDto(null , null , null));
    }

    static function update ($ids) {
        $deviceDto = new DeviceDto(null , null , null) ;
        $deviceDto->setIds($ids) ;

        return $deviceDto ;
    }

    static function delete ($ids) {
        $deviceDto = new DeviceDto(null , null , null) ;
        $deviceDto->setIds($ids) ;

        return $deviceDto ;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getIdent() {
        return $this->ident;
    }

    public function setIdent($ident) {
        $this->ident = $ident;
    }

    public function getDevice_type_id() {
        return $this->device_type_id;
    }

    public function setDevice_type_id($device_type_id) {
        $this->device_type_id = $device_type_id;
    }

    // realm id
    public function getMessages_ttl() {
        return $this->messages_ttl;
    }

    public function setMessages_ttl($messages_ttl) {
        $this->messages_ttl = $messages_ttl;
    }

    public function getMedia_ttl() {
        return $this->media_ttl;
    }

    public function setMedia_ttl($media_ttl) {
        $this->media_ttl = $media_ttl;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getCid() {
        return $this->cid;
    }

    public function setCid($cid) {
        $this->cid = $cid;
    }

    public function getOwner() {
        return $this->cid;
    }

    public function setOwner($cid) {
        $this->cid = $cid;
    }

    public function getIds() {
        return $this->ids;
    }

    public function setIds($ids) {
        $this->ids = $ids;

        return $this ;
    }


    //! calcs
    public function getCalcs() {
        return $this->calcs;
    }

    public function setCalcs($calcs) {
        $this->calcs = $calcs;
    }

    public function getFields() {
        return $this->fields;
    }

    public function setFields($fields) {
        $this->fields = $fields;
    }

    public function getFrom() {
        return $this->from;
    }

    public function setFrom($from) {
        $this->from = $from;
    }


    public function getTo() {
        return $this->to;
    }

    public function setTo($to) {
        $this->to = $to;
    }

    public function getFilter() {
        return $this->filter;
    }

    public function setFilter($filter) {
        $this->filter = $filter;
    }


    public function getSelectors(){
        return $this->selectors;
    }

    public function setSelectors($selectors) {
        $this->selectors = $selectors;
    }

    public function isEnabled(): ?bool {
        return $this->enabled;
    }

    // Setter
    public function setEnabled(?bool $enabled):void {
        $this->enabled = $enabled;
    }


    public function getMetaData() {
        return $this->metadata;
    }

    public function addMetaData(string $key , $value) {
        $this->metadata[$key] = $value ;
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
        $this->isEnabled() !== null ? $data["enabled"] = $this->isEnabled() : null;

        return $data ;

        // var_dump($data) ;
    }


    public function _update() : array {
        $data =[] ;
        ($this->getPhone() != null) ? $data["configuration"]["phone"]=$this->getPhone():null ;
        ($this->getIdent() !== null) ? $data["configuration"]["ident"] = $this->getIdent() : null;
        ($this->getMessages_ttl() != null) ? $data["messages_ttl"]=$this->getMessages_ttl():null ;
        ($this->getMedia_ttl() != null) ? $data["media_ttl"]=$this->getMedia_ttl():null ;
        ($this->isEnabled() !== null) ? $data["enabled"] = $this->isEnabled() : null;
        ($this->getDevice_type_id() != null) ? $data["device_type_id"] = $this->getDevice_type_id() : null;
        ($this->getName() !== null) ? $data["name"] = $this->getName() : null;
        // ($this->getMetaData() !== null) ? $data["metadata"] = $this->getMetaData() : null;

        return $data ;
    }


    /**
     * @see it use to fitler prupose
     */
    public function getData() {
        $data =[] ;
        ($this->getFilter() != null) ? $data["filter"]=$this->getFilter():null ;
        ($this->getFields() != null) ? $data["fields"]=join(",",$this->getFields()):null ;
        ($this->getFrom() != null) ? $data["from"]=$this->getFrom():null ;
        ($this->getTo() != null) ? $data["to"]=$this->getTo():null ;

        return $data ;
    }
}

?>
