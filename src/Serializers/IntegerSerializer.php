<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Serializers;

use Yadddl\Serializer\Serializer;
use Yadddl\ValueObject\Primitive\Integer;

/**
 * @extends Serializer<Integer, int>
 */
class IntegerSerializer implements Serializer
{
    public function __invoke(mixed $object): int
    {
        assert($object instanceof Integer, sprintf('Object cannot be serialized. Expecting "%s", found "%s"', Integer::class, $object::class));

        return $object->toInt();
    }
}
