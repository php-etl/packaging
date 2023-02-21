<?php

declare(strict_types=1);

namespace Kiboko\Component\Packaging;

use Kiboko\Contract\Packaging\DirectoryInterface;
use Kiboko\Contract\Packaging\FileInterface;

final readonly class VirtualDirectory implements DirectoryInterface
{
    private string $path;
    /** @var \ArrayIterator<string, FileInterface|DirectoryInterface> */
    private \ArrayIterator $children;

    public function __construct()
    {
        $this->path = hash('sha512', random_bytes(64)).'.temp';
        $this->children = new \ArrayIterator();
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function add(FileInterface|DirectoryInterface ...$files): self
    {
        foreach ($files as $file) {
            $this->children->append($file);
        }

        return $this;
    }

    public function hasChildren(): bool
    {
        return $this->current() instanceof DirectoryInterface;
    }

    public function getChildren()
    {
        return $this->current();
    }

    public function current()
    {
        return $this->children->current();
    }

    public function next(): void
    {
        $this->children->next();
    }

    public function key()
    {
        return $this->children->key();
    }

    public function valid()
    {
        return $this->children->valid();
    }

    public function rewind(): void
    {
        $this->children->rewind();
    }
}
