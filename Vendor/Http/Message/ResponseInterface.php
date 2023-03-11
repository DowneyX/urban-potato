<?php

namespace Vendor\Http\Message;

interface ResponseInterface extends MessageInterface
{
    public function getStatusCode();

    public function getContent();

    public function send();

    public function sendContent();

    public function sendHeaders();

    public function sendStatus();
}
