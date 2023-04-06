<?php

namespace core\container;

use core\container\ContainerInterface;
use Exception;
use ReflectionClass;

class Container implements ContainerInterface
{
    private $services = [];
    private $configDirectory = __DIR__ . "/../../Container.config.json";

    /**
     * method will provide an instance of the specified class.
     * @param string $id the class path of the specified class.
     * @return object returns the instance of the specifeid class.
     */
    public function get(string $id): object
    {
        //if service exist return sevice
        if ($this->hasService($id)) {
            return $this->services[$id];
        }

        //if it doesn't exist resolve service and add it to the map
        $service = $this->resolve($id);
        $this->services[$id] = $service;
        return $service;
    }

    /**
     * method will check if instance is already defnined.
     * @param string $id the class path of the specified class.
     * @return bool returns true if class is in the map and false otherwise
     */
    public function hasService(string $id): bool
    {
        return isset($this->services[$id]);
    }

    /**
     * method will try to create an instance of the specified class.
     * @param string $classname the class path of the specified class.
     * @return object returns the instance of the specifeid class
     */
    private function resolve(string $className): object
    {
        // check if class exists
        if (!class_exists($className)) {
            throw new Exception("can't find class of name: " . $className);
        }

        // does class have a constructor
        // if no constructor make an instance and return the instance
        $reflection = new ReflectionClass($className);
        if ($reflection->getConstructor() == null) {
            return new $className();
        }

        // if constructor exists check dependencies dependencies
        $parameters = $reflection->getConstructor()->getParameters();

        //create the dependencies
        $dependencies = $this->createDependencies($parameters, $reflection->getShortName());

        // return instance with dependencies
        return $reflection->newInstanceArgs($dependencies);
    }

    /**
     * method will try to create the dependencies for a specifeid class
     * @param array $dependencies array with class constructor parameters
     * @param string $classname name of the class for which the dependencies are made
     * @return array array with the instances of the dependencies
     */
    private function createDependencies(array $dependencies, string $className): array
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

    /**
     * method checks if config exist for a dependency
     * @param string $class classname for wich we need the dependencies
     * @param string $dependency name of the dependency
     * @return bool returns true if config exist false otherwise
     */
    private function hasConfig(string $class, string $dependency): bool
    {
        $jsonFile = file_get_contents($this->configDirectory);
        $jsonData = json_decode($jsonFile, true);
        return !empty($jsonData[$class][$dependency]);
    }
}
