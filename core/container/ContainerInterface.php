<?php

namespace core\container;

interface ContainerInterface
{
    public function get(string $id);

    public function hasService(string $id);
}
