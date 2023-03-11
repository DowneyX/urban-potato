<?php

namespace Vendor\Http\Message;

interface UriInterface
{
    public function getScheme();

    public function getHost();

    public function getPort();

    public function getPath();

    public function getParamsGet();

    public function getParamGet(string $name);

    public function getFragment();
}
