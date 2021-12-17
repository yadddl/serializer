<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Factory;

use Yadddl\Serializer\Registry\SerializerRegistry;
use Yadddl\Serializer\Registry\SerializerRegistryImpl;
use Yadddl\Serializer\Serializers\DateTimeSerializer;
use Yadddl\Serializer\Serializers\IntegerSerializer;
use Yadddl\Serializer\Serializers\IterableSerializerImpl;
use Yadddl\Serializer\Serializers\ObjectSerializerImpl;
use Yadddl\Serializer\Serializers\SerializerImpl;
use Yadddl\ValueObject\Primitive\DateTime;
use Yadddl\ValueObject\Primitive\Integer;

final class SerializerValueObjectFactory implements SerializerFactory
{
    public function __construct()
    {
        assert(class_exists('Yadddl\ValueObject\Primitive\Integer'), 'You should require yadddl/value-object library in order to use this class');
    }

    public function __invoke(): SerializerImpl
    {
        $registry = new SerializerRegistryImpl();

        $this->configure($registry);

        return new SerializerImpl(new IterableSerializerImpl(), new ObjectSerializerImpl($registry));
    }

    protected function configure(SerializerRegistry $registry): void
    {
        $registry->register(Integer::class, new IntegerSerializer());
        $registry->register(DateTime::class, new DateTimeSerializer());
    }

    public static function make(): SerializerImpl
    {
        return (new self())();
    }
}
