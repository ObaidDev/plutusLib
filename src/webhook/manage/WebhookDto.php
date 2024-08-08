<?php


namespace Fdvice\webhook\manage ;
use Fdvice\webhook\manage\TriggerDto ;

final class WebhookDto
{

    private $configuration;
    private $triggers;
    private $enabled;
    private $queue_ttl;
    private $metadata;
    private $method = "POST";
    private $type = "custom-server";
    private $uri ;
    private $delay ;
    private $name ;
    private $body = '{"data":%payload%}';

    private $ids ;




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

    public function getTriggers(): array
    {
        return $this->triggers;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function getQueueTtl(): int
    {
        return $this->queue_ttl;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getIds()
    {
        return $this->ids;
    }


    // Setters
    public function setConfiguration(?array $configuration): void
    {
        $this->configuration = $configuration;
    }

    public function setTriggers(array $triggers): void
    {
        $this->triggers = $triggers;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function setQueueTtl(int $queue_ttl): void
    {
        $this->queue_ttl = $queue_ttl;
    }

    public function setMetadata(array $metadata): void
    {
        $this->metadata = $metadata;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function setIds($ids): void
    {
        $this->ids = $ids;    
    }


    public function _create() : array {

        $data =[] ;
        // var_dump($this->isEnabled()) ;
        ($this->getName() != null) ? $data["name"]=$this->getName():null ;

        ($this->getType() != null) ? $data["configuration"]["type"]=$this->getType():null ;
        ($this->getUri() != null) ? $data["configuration"]["uri"]=$this->getUri():null ;
        ($this->getMethod() != null) ? $data["configuration"]["method"]=$this->getMethod():null ;
        ($this->getBody() != null) ? $data["configuration"]["body"]=$this->getBody():null ;

        ($this->getTriggers() != null) ? $data["triggers"]=array_map(function ($triger) : array {
            return $triger->_create() ;
        } , $this->getTriggers()):null ;
        // var_dump($data) ;
        // die()  ;
        return $data ;

        // return $data ;
    }
}
