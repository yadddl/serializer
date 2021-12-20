<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Serializers;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @covers \Yadddl\Serializer\Serializers\SerializerImpl
 */
class SerializerImplTest extends TestCase
{
    use ProphecyTrait;

    public function test(): void {
        $iterableSerializer = $this->prophesize(IterableSerializer::class);
        $objectSerializer = $this->prophesize(ObjectSerializer::class);

        $serializer = new SerializerImpl($iterableSerializer->reveal(), $objectSerializer->reveal());

        $input = new \DateTimeImmutable();

        $serializer($input);

        $objectSerializer->__invoke($input)->shouldHaveBeenCalledOnce();
        $iterableSerializer->__invoke($input)->shouldNotHaveBeenCalled();

        $serializer([]);

        $iterableSerializer->__invoke([])->shouldHaveBeenCalledOnce();
        $objectSerializer->__invoke([])->shouldNotHaveBeenCalled();

        $serializer(1);
        $iterableSerializer->__invoke(1)->shouldNotHaveBeenCalled();
        $objectSerializer->__invoke(1)->shouldNotHaveBeenCalled();
    }
}