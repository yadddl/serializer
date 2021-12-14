<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Serializers;

use Yadddl\Serializer\Serializer;

class IterableSerializerImpl implements IterableSerializer
{
    private ?Serializer $serializer;

    public function __invoke(mixed $object): array
    {
        $result = [];

        /** @var mixed */
        foreach ($object as $item) {
            /** @var mixed */
            $result[] = $this->serializer ? ($this->serializer)($item) : $item;
        }

        return $result;
    }

    public function setParent(Serializer $serializer): void
    {
        $this->serializer = $serializer;
    }
}
