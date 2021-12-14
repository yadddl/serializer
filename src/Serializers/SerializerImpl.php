<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Serializers;

use Yadddl\Serializer\Serializer;

class SerializerImpl implements Serializer
{
    private IterableSerializer $iterableSerializer;
    private ObjectSerializer $objectSerializer;

    public function __construct(
        IterableSerializer $iterableSerializer,
        ObjectSerializer $objectSerializer
    ) {
        $this->iterableSerializer = $iterableSerializer;
        $this->iterableSerializer->setParent($this);

        $this->objectSerializer = $objectSerializer;
        $this->objectSerializer->setParent($this);
    }

    public function __invoke(mixed $object): mixed
    {
        return match (true) {
            is_iterable($object) => ($this->iterableSerializer)($object),
            is_object($object) => ($this->objectSerializer)($object),
            default => $object
        };
    }
}
