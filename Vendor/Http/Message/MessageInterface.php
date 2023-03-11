<?php

namespace Vendor\Http\Message;

interface MessageInterface
{
    public function getProtocolVersion();

    public function getHeaders();

    public function getHeader(string $name);
}
