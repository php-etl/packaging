<?php

declare(strict_types=1);

namespace Kiboko\Component\Packaging;

use Kiboko\Contract\Packaging\AssetInterface;
use Kiboko\Contract\Packaging\FileInterface;

final readonly class VirtualFile implements FileInterface
{
    private string $path;

    public function __construct(private AssetInterface $content)
    {
        $this->path = hash('sha512', random_bytes(64)).'.temp';
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function asResource()
    {
        return $this->content->asResource();
    }
}
