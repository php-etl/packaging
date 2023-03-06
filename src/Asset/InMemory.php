<?php

declare(strict_types=1);

namespace Kiboko\Component\Packaging\Asset;

use Kiboko\Contract\Packaging\AssetInterface;

final class InMemory implements AssetInterface
{
    /** @var resource */
    private $stream;

    public function __construct(string $content)
    {
        $resource = fopen('php://temp', 'rb+');
        if (false === $resource) {
            throw new \RuntimeException('Could not store the in-memory data in a new temporary resource.');
        }
        $this->stream = $resource;

        fwrite($this->stream, $content);
        fseek($this->stream, 0, \SEEK_SET);
    }

    /** @return resource */
    public function asResource()
    {
        $resource = fopen('php://temp', 'rb+');
        if (false === $resource) {
            throw new \RuntimeException('Could not store the in-memory data in a new temporary resource.');
        }
        fseek($this->stream, 0, \SEEK_SET);
        stream_copy_to_stream($this->stream, $resource);
        fseek($resource, 0, \SEEK_SET);
        fseek($this->stream, 0, \SEEK_END);

        return $resource;
    }
}
