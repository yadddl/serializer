<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Registry;

use Yadddl\Serializer\Serializer;

class SerializerRegistryImpl implements SerializerRegistry
{
    /** @psalm-var array<class-string, callable|Serializer> */
    private array $serializers = [];

    /**
     * @param class-string $className
     * @param callable|Serializer $serializer
     */
    public function register(string $className, callable|Serializer $serializer): void
    {
        $this->serializers[$className] = $serializer;
    }

    public function serializerFor(object|string $object): callable|Serializer|null
    {
        $lastSerializer = null;

        foreach ($this->serializers as $className => $serializer) {
            if (is_a($object, $className, true)) {
                $lastSerializer = $serializer;
            }
        }

        return $lastSerializer;
    }
}
