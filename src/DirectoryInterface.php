<?php

declare(strict_types=1);

namespace Kiboko\Component\Packaging;

interface DirectoryInterface extends \RecursiveIterator
{
    public function getPath(): string;
}
