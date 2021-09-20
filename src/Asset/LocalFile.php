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
        $resource = fopen($this->path, 'rb');
        if ($resource === false) {
            throw new \RuntimeException(strtr('Could not open the file at path %path%.', ['%path%' => $this->path]));
        }

        return $resource;
    }
}
