<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Factory;

use Yadddl\Serializer\Registry\SerializerRegistryImpl;
use Yadddl\Serializer\Serializer;
use Yadddl\Serializer\Serializers\IterableSerializerImpl;
use Yadddl\Serializer\Serializers\ObjectSerializerImpl;
use Yadddl\Serializer\Serializers\SerializerImpl;

final class SerializerBaseFactory implements SerializerFactory
{
    /**
     * @param array<callable|Serializer> $serializers
     *
     * @return callable|Serializer
     */
    public function __invoke(array $serializers = []): callable|Serializer
    {
        return new SerializerImpl(
            new IterableSerializerImpl(),
            new ObjectSerializerImpl(new SerializerRegistryImpl())
        );
    }

    /**
     * @param array<callable|Serializer> $serializers
     *
     * @return Serializer
     */
    public static function make(array $serializers = []): Serializer
    {
        $factory = new self();

        return $factory($serializers);
    }
}
