<?php

namespace core\container;

use core\container\ContainerInterface;
use Exception;
use ReflectionClass;

class Container implements ContainerInterface
{
    private $services = [];

    public function get($id)
    {
        //if service exist return sevice
        if ($this->has($id)) {
            return $this->services[$id];
        }

        //if it doesn't exist resolve service and add it to the map
        $service = $this->resolve($id);
        $this->services[$id] = $service;
        return $service;
    }
    public function has($id)
    {
        return isset($this->services[$id]);
    }

    private function resolve($class)
    {
        // check if class exists
        if (!class_exists($class)) {
            throw new Exception("can't find class of name: " . $class);
        }

        // does class have a constructor
        // if no constructor make instance return instance
        $reflection = new ReflectionClass($class);
        if ($reflection->getConstructor() == null) {
            var_dump($class);
            return new $class();
        }

        // if constructor exists create dependencies
        $parameters = $reflection->getConstructor()->getParameters();
        $dependencies = $this->createDependencies($parameters);

        // return instance with dependencies
        return $reflection->newInstanceArgs($dependencies);
    }

    private function createDependencies(array $dependencies)
    {
        foreach ($dependencies as $dependency) {
            $returnDependencies[] = $this->resolve($dependency->getClass()->getName());
        }
        return $returnDependencies;
    }
}
