<?php

namespace Fdvice\plugins\manage ;



interface PluginInterface {

    function addPlugin(PluginDto $pluginDto , $userToken) : array ;
    public function addPlugins($plugins , $userToken ): array ;
}