<?php declare(strict_types=1);

namespace Kiboko\Component\Packaging\Asset;

use Kiboko\Component\Packaging\AssetInterface;
use PhpParser\Node;
use PhpParser\PrettyPrinter;

final class AST implements AssetInterface
{
    public function __construct(private Node $node)
    {}

    /** @return resource */
    public function asResource()
    {
        $resource = fopen('php://temp', 'rb+');
        file_put_contents($resource, (new PrettyPrinter\Standard())->prettyPrintFile($this->node));
        fseek($resource, 0, SEEK_SET);
        return $resource;
    }
}
