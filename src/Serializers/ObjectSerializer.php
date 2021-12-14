<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Serializers;

use Yadddl\Serializer\Serializer;

/**
 * @extends Serializer<object, array|int|string|bool|object|null>
 */
interface ObjectSerializer extends Serializer
{
    public function setParent(Serializer $serializer): void;
}
