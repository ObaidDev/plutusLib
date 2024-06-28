<?php


namespace Fdvice\plugins\manage ;

use stdClass;

final class PluginDto
{
    private bool $required = false ;
    private bool $enabled = true ;
    private string $validate_message = "" ;
    private $item_type ;
    private $name ;
    private $configuration;
    private $priority = 0 ;
    private $type_id ;
    private $timezone = "UTC" ;
    private $cid = null ;

    // ids instead of id because whene we need the id we need a list of it not just one id .
    private $ids ;


    private function __construct() {
    
    }

    static function emptyConstruct(){
        return (new PluginDto());
    }


    static function create($name , $item_type , $type_id , $configuration){
        $pluginDto = new PluginDto() ;
        $pluginDto->setName($name);
        $pluginDto->setItemType($item_type);
        $pluginDto->setTypeId($type_id);
        $pluginDto->setConfiguration($configuration);
        
        return $pluginDto;

    }


    // Getter and Setter for $required
    public function isRequired(): bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }

    // Getter and Setter for $enabled
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    // Getter and Setter for $validate_message
    public function getValidateMessage(): string
    {
        return $this->validate_message;
    }

    public function setValidateMessage(string $validate_message): void
    {
        $this->validate_message = $validate_message;
    }

    // Getter and Setter for $item_type
    public function getItemType()
    {
        return $this->item_type;
    }

    public function setItemType($item_type): void
    {
        $this->item_type = $item_type;
    }


    public function getIds()
    {
        return $this->ids;
    }

    public function setIds($ids): void
    {
        $this->ids = $ids;    }

    // Getter and Setter for $name
    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getConfiguration()
    {
        return $this->configuration;
    }

    public function setConfiguration($configuration): void
    {
        $this->configuration = $configuration;
    }

    // Getter and Setter for $priority
    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    // Getter and Setter for $type_id
    public function getTypeId()
    {
        return $this->type_id;
    }

    public function setTypeId($type_id): void
    {
        $this->type_id = $type_id;
    }

    // Getter and Setter for $timezone
    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function setTimezone(string $timezone): void
    {
        $this->timezone = $timezone;
    }

    public function getCid()
    {
        return $this->cid;
    }

    public function setCid($cid): void
    {
        $this->cid = $cid;
    }


    public function _create() : array {
        
        $data = [
            "required"=>$this->isRequired() ,
            "enabled"=>$this->isEnabled() ,
            "validate_message"=>$this->validate_message,
            "item_type"=>$this->getItemType(),
            "name"=>$this->getName(),
            "configuration"=>($this->getConfiguration() != null ? $this->getConfiguration() : new \stdClass),
            "priority"=>$this->getPriority() ,
            "type_id"=>$this->getTypeId() ,
            "timezone"=>$this->getTimezone()

        ];

        return $data ;
    }


}
