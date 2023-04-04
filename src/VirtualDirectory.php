<?php

declare(strict_types=1);

namespace Kiboko\Component\Packaging;

use Kiboko\Contract\Packaging\DirectoryInterface;
use Kiboko\Contract\Packaging\FileInterface;
use ReturnTypeWillChange;

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

    #[\ReturnTypeWillChange]
    public function getChildren()
    {
        return $this->current();
    }

    #[\ReturnTypeWillChange]
    public function current()
    {
        return $this->children->current();
    }

    public function next(): void
    {
        $this->children->next();
    }

    #[\ReturnTypeWillChange]
    public function key()
    {
        return $this->children->key();
    }

    #[\ReturnTypeWillChange]
    public function valid()
    {
        return $this->children->valid();
    }

    public function rewind(): void
    {
        $this->children->rewind();
    }
}
