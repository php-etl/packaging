<?php

declare(strict_types=1);

namespace Kiboko\Component\Packaging;

use Kiboko\Contract\Packaging\DirectoryInterface;
use Kiboko\Contract\Packaging\FileInterface;

final class Directory implements DirectoryInterface
{
    private \RecursiveIterator $iterator;

    public function __construct(private readonly string $path)
    {
        $this->iterator = new \RecursiveDirectoryIterator(
            $path,
            \RecursiveDirectoryIterator::SKIP_DOTS
            | \RecursiveDirectoryIterator::FOLLOW_SYMLINKS
            | \RecursiveDirectoryIterator::CURRENT_AS_FILEINFO
            | \RecursiveDirectoryIterator::KEY_AS_PATHNAME | \FilesystemIterator::SKIP_DOTS
        );
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function hasChildren(): bool
    {
        return $this->iterator->hasChildren();
    }

    public function getChildren(): self
    {
        $child = clone $this;
        $child->iterator = $this->iterator->getChildren();

        return $child;
    }

    public function current(): FileInterface|DirectoryInterface
    {
        $current = $this->iterator->current();
        if ($current->isDir()) {
            return new self($current->getPathname());
        }

        return new File(
            $current->getPathname(),
            new Asset\LocalFile($current->getPathname())
        );
    }

    public function next(): void
    {
        $this->iterator->next();
    }

    public function key(): string
    {
        return $this->iterator->key();
    }

    public function valid(): bool
    {
        return $this->iterator->valid();
    }

    public function rewind(): void
    {
        $this->iterator->rewind();
    }
}
