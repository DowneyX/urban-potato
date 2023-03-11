<?php

namespace Vendor\Http\Message;

interface RequestInterface extends MessageInterface
{
    public function getMethod();
}
