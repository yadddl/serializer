<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Serializers;

use Yadddl\Serializer\Serializer;
use Yadddl\ValueObject\Primitive\DateTime;

/**
 * @extends Serializer<DateTime, string>
 */
class DateTimeSerializer implements Serializer
{
    public function __invoke(mixed $object): string
    {
        assert($object instanceof DateTime);

        return $object->format('Y-m-d');
    }
}
