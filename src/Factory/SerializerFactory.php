<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Factory;

use Yadddl\Serializer\Serializer;

interface SerializerFactory
{
    public function __invoke(): callable|Serializer;
}
