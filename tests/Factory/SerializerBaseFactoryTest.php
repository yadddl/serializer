<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Factory;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Yadddl\Serializer\Serializers\SerializerImpl;

/**
 * @covers \Yadddl\Serializer\Factory\SerializerBaseFactory
 */
class SerializerBaseFactoryTest extends TestCase
{
    public function test_invoke(): void
    {
        $factory = new SerializerBaseFactory();

        $serializer = $factory();

        Assert::assertInstanceOf(SerializerImpl::class, $serializer);
    }

    public function test_make(): void
    {
        $serializer = SerializerBaseFactory::make();

        Assert::assertInstanceOf(SerializerImpl::class, $serializer);
    }

    public function test_configuration(): void
    {
        $serializer = SerializerBaseFactory::make();

        $dto = new SillyDTO('one', 2, 'hidden');

        $expected = [
            'propertyOne' => 'one',
            'propertyTwo' => 2,
            'hiddenProperty' => true,
        ];

        Assert::assertSame($expected, $serializer($dto));
    }
}

class SillyDTO
{
    public function __construct(
        private string $propertyOne,
        private int    $propertyTwo,
        private string $hiddenProperty
    )
    {
    }

    public function getPropertyOne(): string
    {
        return $this->propertyOne;
    }

    public function getPropertyTwo(): int
    {
        return $this->propertyTwo;
    }

    public function hasHiddenProperty(): bool
    {
        return !empty($this->hiddenProperty);
    }
}
