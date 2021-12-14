<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Serializers;

use ReflectionClass;
use ReflectionProperty;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Yadddl\Serializer\Registry\SerializerRegistry;
use Yadddl\Serializer\Serializer;

class ObjectSerializerImpl implements ObjectSerializer
{
    private Serializer $serializer;
    private ?SerializerRegistry $serializerRegistry;

    public function __construct(SerializerRegistry $serializerRegistry = null)
    {
        $this->serializerRegistry = $serializerRegistry;
    }

    public function __invoke(mixed $object): mixed
    {
        return $this->serializeObjects($object);
    }

    public function setParent(Serializer $serializer): void
    {
        $this->serializer = $serializer;
    }

    /**
     * @return ReflectionProperty[]
     */
    private function getProperties(object $object): array
    {
        $class = $object instanceof \ReflectionClass
            ? $object
            : new ReflectionClass($object);

        $parentClass = $class->getParentClass();

        return $parentClass
            ? array_merge($this->getProperties($parentClass), $class->getProperties())
            : $class->getProperties();
    }

    private function serializeObjects(object $object): mixed
    {
        $serializer = ($this->serializerRegistry)
            ? $this->serializerRegistry->serializerFor($object)
            : null;

        if ($serializer) {
            return $serializer($object);
        }

        // I know there's a Stringable interface, but I think is better to not depend on it
        if (method_exists($object, '__toString')) {
            return (string)$object;
        }

        $properties = $this->getProperties($object);

        $result = [];

        foreach ($properties as $property) {
            $this->setValue($property, $object, $result);
        }

        return $result;
    }

    private function setValue(ReflectionProperty $property, object $object, array &$result): void
    {
        $name = $property->getName();

        $accessor = PropertyAccess::createPropertyAccessor();

        if ($accessor->isReadable($object, $name)) {
            /** @var mixed $value */
            $value = $accessor->getValue($object, $name);

            /** @var mixed */
            $result[$name] = ($this->serializer)($value);
        }
    }
}
