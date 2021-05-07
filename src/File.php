<?php

declare(strict_types=1);

namespace Kiboko\Component\Packaging;

use Kiboko\Contract\Packaging\AssetInterface;
use Kiboko\Contract\Packaging\FileInterface;

final class File implements FileInterface
{
    private string $path;
    private AssetInterface $content;

    public function __construct(string $path, AssetInterface $content)
    {
        $this->path = $path;
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
