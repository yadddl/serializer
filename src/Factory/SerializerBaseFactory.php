<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Factory;

use Yadddl\Serializer\Serializer;
use Yadddl\Serializer\Serializers\IterableSerializerImpl;
use Yadddl\Serializer\Serializers\ObjectSerializerImpl;
use Yadddl\Serializer\Serializers\SerializerImpl;

final class SerializerBaseFactory implements SerializerFactory
{
    public function __invoke(): callable|Serializer
    {
        return new SerializerImpl(
            new IterableSerializerImpl(),
            new ObjectSerializerImpl()
        );
    }

    public static function make(): Serializer
    {
        return (new self())();
    }
}
