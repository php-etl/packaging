<?php

declare(strict_types=1);

namespace Kiboko\Component\Packaging\Asset;

use Kiboko\Contract\Packaging\AssetInterface;

final class LocalFile implements AssetInterface
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /** @return resource */
    public function asResource()
    {
        return fopen($this->path, 'rb');
    }
}
