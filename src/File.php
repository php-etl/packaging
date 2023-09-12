<?php

declare(strict_types=1);

namespace Kiboko\Component\Packaging;

use Kiboko\Contract\Packaging\AssetInterface;
use Kiboko\Contract\Packaging\FileInterface;

final readonly class File implements FileInterface
{
    public function __construct(private string $path, private AssetInterface $content) {}

    public function getPath(): string
    {
        return $this->path;
    }

    public function asResource()
    {
        return $this->content->asResource();
    }
}
