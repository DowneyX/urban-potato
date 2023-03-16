<?php

namespace core\container;

use container\ContainerInterface;

class Container implements ContainerInterface
{
    private $services = array();

    public function set($id, $service)
    {
        $this->services[$id] = $service;
    }

    public function get($id)
    {
        if (!$this->has($id)) {
            throw new \Exception("Service not found: $id");
        }

        return $this->services[$id];
    }
    public function has($id)
    {
        return isset($this->services[$id]);
    }
}
