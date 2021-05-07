<?php

declare(strict_types=1);

namespace Kiboko\Component\Packaging;

use Kiboko\Contract\Packaging\AssetInterface;
use Kiboko\Contract\Packaging\FileInterface;

final class VirtualFile implements FileInterface
{
    private string $path;
    private AssetInterface $content;

    public function __construct(AssetInterface $content)
    {
        $this->path = hash('sha512', random_bytes(64)).'.temp';
        $this->content = $content;
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
