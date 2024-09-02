<?php


namespace Fdvice\webhook\manage ;
use Fdvice\webhook\manage\TriggerDto ;

final class WebhookDto
{

    private $configuration;
    private $triggers;
    private $enabled = null;
    private $queue_ttl;
    private $metadata;
    private $method = "POST";
    private $type = "custom-server";
    private $uri ;
    private $delay ;
    private $name ;
    private $body = '{"data":%payload%}';
    private $fields = ["name" , "enabled" , "id"];
    private $ids ;
    private $headers=[] ;




    private function __construct() {

    }


    static function emptyConstruct(){
        return (new WebhookDto());
    }

    static function createWebhook($name , $triggers , $uri) : WebhookDto {
        $webhookDto = new WebhookDto() ;
        $webhookDto->setTriggers($triggers) ;
        $webhookDto->setUri($uri) ;
        $webhookDto->setName($name) ;

        return $webhookDto ;

    }



    public function getConfiguration(): ?array
    {
        return $this->configuration;
    }

    public function getTriggers(): ?array
    {
        return $this->triggers;
    }

    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function getQueueTtl(): ?int
    {
        return $this->queue_ttl;
    }

    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function getUri(): ?string
    {
        return $this->uri;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function getIds()
    {
        return $this->ids;
    }

    public function getHeaders() :array {
        return $this->headers ;
    }


    // Setters
    public function setConfiguration(?array $configuration)
    {
        $this->configuration = $configuration;

        return $this ;
    }

    public function setTriggers(array $triggers)
    {
        $this->triggers = $triggers;
        return $this ;
    }

    public function setEnabled(?bool $enabled)
    {
        $this->enabled = $enabled;
        return $this ;
    }

    public function setQueueTtl(int $queue_ttl)
    {
        $this->queue_ttl = $queue_ttl;
        return $this ;
    }

    public function setMetadata(array $metadata)
    {
        $this->metadata = $metadata;
        return $this ;
    }

    public function setMethod(string $method)
    {
        $this->method = $method;
        return $this ;
    }

    public function setUri(string $uri)
    {
        $this->uri = $uri;
        return $this ;
    }

    public function setType(string $type)
    {
        $this->type = $type;
        return $this ;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this ;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
        return $this ;
    }

    public function setIds($ids)
    {
        $this->ids = $ids ;
        return $this ;
    }

    public function getFields() {
        return $this->fields;
    }

    public function setFields($fields) {
        $this->fields = $fields;
    }

    public function setHead($key , $value) {
        // $mainHeader = [];
        $mainHeader= [
            "name" => $key,
            "value" => $value
        ];

        // $headers = $this->getHeaders();  // Get the current headers array
        $headers =[] ;        // Add the new header to the array
        array_push($headers , $mainHeader) ;
        $this->headers = $headers;       // Set the modified headers back to the class property

        return $this;
    }


    public function _create() : array {

        $data =[] ;
        ($this->getName() != null) ? $data["name"]=$this->getName():null ;
        ($this->isEnabled() != null) ? $data["enabled"]=$this->isEnabled():null ;

        ($this->getType() != null) ? $data["configuration"]["type"]=$this->getType():null ;
        ($this->getUri() != null) ? $data["configuration"]["uri"]=$this->getUri():null ;
        ($this->getMethod() != null) ? $data["configuration"]["method"]=$this->getMethod():null ;
        ($this->getBody() != null) ? $data["configuration"]["body"]=$this->getBody():null ;
        ($this->getHeaders() != null) ? $data["configuration"]["headers"]=array_values($this->getHeaders()):null ;

        ($this->getTriggers() != null) ? $data["triggers"]=array_map(function ($triger) : array {
            return $triger->_create() ;
        } , $this->getTriggers()):null ;

        return $data ;

    }

    public function _update() : array {

        $data =[] ;
        ($this->getName() != null) ? $data["name"]=$this->getName():null ;
        $this->isEnabled() !== null ? $data["enabled"] = $this->isEnabled() : null;

        ($this->getType() != "custom-server") ? $data["configuration"]["type"]=$this->getType():null ;
        ($this->getUri() != null) ? $data["configuration"]["uri"]=$this->getUri():null ;
        ($this->getMethod() != "POST") ? $data["configuration"]["method"]=$this->getMethod():null ;
        ($this->getHeaders() != null) ? $data["configuration"]["headers"]=array_values($this->getHeaders()):null ;

        ($this->getBody() != '{"data":%payload%}') ? $data["configuration"]["body"]=$this->getBody():null ;

        ($this->getTriggers() != null) ? $data["triggers"]=array_map(function ($triger) : array {
            return $triger->_create() ;
        } , $this->getTriggers()):null ;

        return $data ;

    }
}
