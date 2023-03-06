<?php

declare(strict_types=1);

namespace Kiboko\Component\Packaging\Asset;

use Kiboko\Contract\Packaging\AssetInterface;
use PhpParser\Node;
use PhpParser\PrettyPrinter;

final readonly class AST implements AssetInterface
{
    public function __construct(private Node $node)
    {
    }

    /** @return resource */
    public function asResource()
    {
        $resource = fopen('php://temp', 'rb+');
        if (false === $resource) {
            throw new \RuntimeException('Could not store the produced code in a temporary resource.');
        }
        fwrite($resource, (new PrettyPrinter\Standard())->prettyPrintFile([$this->node]));
        fseek($resource, 0, \SEEK_SET);

        return $resource;
    }
}
