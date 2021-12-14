<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Serializers;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Yadddl\Serializer\Serializer;
use Yadddl\ValueObject\Primitive\Date;
use Yadddl\ValueObject\Primitive\Text;

/**
 * @covers \Yadddl\Serializer\Serializers\IterableSerializerImpl
 */
class IterableSerializerImplTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @test
     */
    public function shouldSerializeEmptyArray(): void
    {
        $serializer = new IterableSerializerImpl();

        $collection = [];

        Assert::assertSame([], $serializer($collection));
    }

    /**
     * @test
     */
    public function shouldSerializeOneItem(): void
    {
        $serializer = new IterableSerializerImpl();
        $object = Text::create('bar');

        $parentSerializer = $this->prophesize(Serializer::class);
        $parentSerializer->__invoke($object)->shouldBeCalledOnce()->willReturn((string)$object);

        $serializer->setParent($parentSerializer->reveal());

        $collection = [$object];

        Assert::assertSame(['bar'], $serializer($collection));
    }

    /**
     * @test
     */
    public function shouldSerializeThreeItem(): void
    {
        $serializer = new IterableSerializerImpl();

        $object1 = Text::create('foo');
        $object2 = Text::create('bar');
        $object3 = Text::create('baz');

        $parentSerializer = $this->prophesize(Serializer::class);

        $parentSerializer->__invoke($object1)->shouldBeCalledOnce()->willReturn((string)$object1);
        $parentSerializer->__invoke($object2)->shouldBeCalledOnce()->willReturn((string)$object2);
        $parentSerializer->__invoke($object3)->shouldBeCalledOnce()->willReturn((string)$object3);

        $serializer->setParent($parentSerializer->reveal());

        $collection = [$object1, $object2, $object3];

        Assert::assertSame(['foo', 'bar', 'baz'], $serializer($collection));
    }

    /**
     * @test
     */
    public function shouldBroke(): void {
        $this->expectException(\Error::class);

        $serializer = new IterableSerializerImpl();

        $serializer(Date::now());
    }
}
