<?php

namespace core\container;

interface ContainerInterface
{
    public function get($id);

    public function has($id);
}
