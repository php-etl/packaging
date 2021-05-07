<?php

declare(strict_types=1);

namespace Kiboko\Component\Packaging;

interface AssetInterface
{
    /** @return resource */
    public function asResource();
}
