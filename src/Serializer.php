<?php

declare(strict_types=1);

namespace Yadddl\Serializer;

/**
 * @template I
 * @template O
 */
interface Serializer
{
    /**
     * @psalm-param I $object
     * @psalm-return O
     */
    public function __invoke(mixed $object): mixed;
}
