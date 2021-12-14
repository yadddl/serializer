<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Serializers;

use Yadddl\Serializer\Serializer;

/**
 * @extends Serializer<iterable, array>
 */
interface IterableSerializer extends Serializer
{
    public function setParent(Serializer $serializer): void;
}
