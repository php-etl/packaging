<?php declare(strict_types=1);

namespace unit\Kiboko\Component\Packaging;

use Kiboko\Component\Packaging\FileInterface;

final class FileStub implements FileInterface
{
    public function __construct(private string $path, private string $content = '')
    {}

    public function getPath(): string
    {
        return $this->path;
    }

    /** @return resource */
    public function asResource()
    {
        $resource = fopen('php://temp', 'rb+');
        file_put_contents($resource, $this->content);
        fseek($resource, 0, SEEK_SET);
        return $resource;
    }
}
