<?php

namespace container;

interface ContainerInterface
{
    public function get($id);

    public function has($id);
}
