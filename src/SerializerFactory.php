<?php

declare(strict_types=1);

namespace Yadddl\Serializer;

interface SerializerFactory
{
    public function __invoke(): Serializer;
}
