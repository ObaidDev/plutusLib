<?php

namespace Fdvice\geofence\manage;




class GeofenceDto {

    private $name;
    private $geometry;
    private $enabled = true;
    private $metadata = null;
    private $priority = null;
    private $cid = null ;
    private $ids;
    private $calcsIds;
    private $devicesIds;
    private $pluginsIds;
    private $fields = null;



    static function emptyConstruct() {
        return (new GeofenceDto()) ;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getIds() {
        return $this->ids;
    }

    public function setIds($ids): void {
        $this->ids = $ids;
    }

    public function getCalcsIds() {
        return $this->calcsIds;
    }

    public function setCalcsIds($calcsIds): void {
        $this->calcsIds = $calcsIds;
    }

    public function getpluginsIds() {
        return $this->pluginsIds;
    }

    public function setPluginsIds($pluginsIds): void {
        $this->pluginsIds = $pluginsIds;
    }

    public function getDevicesIds() {
        return $this->devicesIds;
    }

    public function setDevicesIds($devicesIds): void {
        $this->devicesIds = $devicesIds;
    }

    public function getCid() {
        return $this->cid;
    }

    public function setCid($cid): void {
        $this->cid = $cid;
    }




    public function getGeometry(): array {
        return $this->geometry;
    }

    public function setGeometry(array $geometry): void {
        $this->geometry = $geometry;
    }

    public function isEnabled(): bool {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void {
        $this->enabled = $enabled;
    }

    public function getMetadata(): array {
        return $this->metadata;
    }

    public function setMetadata(array $metadata): void {
        $this->metadata = $metadata;
    }

    public function getPriority(): int {
        return $this->priority;
    }

    public function setPriority(int $priority): void {
        $this->priority = $priority;
    }
    
    public function getFields() {
        return $this->fields;
    }

    public function setFields($fields) {
        $this->fields = $fields;
    }

    function _create() : array {
        

        return [
            "message"=>"create method in the GeofenceDto class is empty and we overwrite it in the subclass !"
        ] ;
    }
    
}