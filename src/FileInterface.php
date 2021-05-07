<?php

namespace Kiboko\Component\Packaging;

interface FileInterface extends AssetInterface
{
    public function getPath(): string;
}
