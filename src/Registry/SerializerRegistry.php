<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Registry;

use Yadddl\Serializer\Serializer;

interface SerializerRegistry
{
    /**
     * @param class-string $className
     * @param callable|Serializer $serializer
     */
    public function register(string $className, callable|Serializer $serializer): void;

    /**
     * @param object $object
     *
     * @return Serializer|callable|null
     */
    public function serializerFor(object $object): Serializer|callable|null;
}
