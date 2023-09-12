<?php

declare(strict_types=1);

namespace Kiboko\Component\Packaging\Asset;

use Kiboko\Contract\Packaging\AssetInterface;

final readonly class LocalFile implements AssetInterface
{
    public function __construct(private string $path) {}

    public function getPath(): string
    {
        return $this->path;
    }

    /** @return resource */
    public function asResource()
    {
        $resource = fopen($this->path, 'rb');
        if (false === $resource) {
            throw new \RuntimeException(strtr('Could not open the file at path %path%.', ['%path%' => $this->path]));
        }

        return $resource;
    }
}
