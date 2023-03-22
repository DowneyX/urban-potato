<?php

namespace core\container;

use core\container\ContainerInterface;
use core\http\message\HttpRequest;
use Exception;
use ReflectionClass;

class Container implements ContainerInterface
{
    private $services = [];

    private $configDirectory = __DIR__ . "/../../Container.config.json";

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
            return new $class();
        }

        // if constructor exists create dependencies
        $parameters = $reflection->getConstructor()->getParameters();
        $dependencies = $this->createDependencies($parameters, $reflection->getShortName());

        // return instance with dependencies
        return $reflection->newInstanceArgs($dependencies);
    }

    private function createDependencies(array $dependencies, string $className)
    {
        foreach ($dependencies as $dependency) {
            $dependencyName = $dependency->getName();
            // if class has config and dependency is in config
            if ($this->hasConfig($className, $dependency->getName())) {
                // get right value from config
                $jsonFile = file_get_contents($this->configDirectory);
                $jsonData = json_decode($jsonFile, true);

                switch ($jsonData[$className][$dependencyName]["method"]) {
                    case "direct":
                        // will get the value directly from the json file
                        $dependencyValue = $jsonData[$className][$dependencyName]["value"];
                        $returnDependencies[$dependencyName] = $dependencyValue;
                        break;
                    case "callback":
                        // will get the value from a callback function
                        $dependencyValue = $jsonData[$className][$dependencyName]["value"];
                        $returnDependencies[$dependencyName] = call_user_func($dependencyValue);
                        break;
                    case "default":
                        // will assume the default value of the parameter
                        break;
                }
                continue;
            }

            // get the dependency through regular means
            $returnDependencies[$dependency->getName()] = $this->get($dependency->getClass()->getName());
        }
        return $returnDependencies;
    }
    private function hasConfig(string $class, $dependency): bool
    {
        $jsonFile = file_get_contents($this->configDirectory);
        $jsonData = json_decode($jsonFile, true);
        return !empty($jsonData[$class][$dependency]);
    }
}