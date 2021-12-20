<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Integration;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Yadddl\Serializer\Serializers\IterableSerializerImpl;
use Yadddl\Serializer\Serializers\ObjectSerializerImpl;
use Yadddl\Serializer\Serializers\SerializerImpl;

class SerializerTest extends TestCase
{
    use ProphecyTrait;

    public function test(): void
    {
        $iterableSerializer = new IterableSerializerImpl();
        $objectSerializer = new ObjectSerializerImpl();

        $serializer = new SerializerImpl($iterableSerializer, $objectSerializer);

        $input = new MyDTO('Ciao');

        $output = $serializer($input);

        $expectedOutput = [
            'publicProperty' => 'Ciao'
        ];

        Assert::assertSame($expectedOutput, $output);
    }
}

class MyDTO
{
    public function __construct(public string $publicProperty)
    {
    }

    public function getPublicProperty(): string
    {
        return $this->publicProperty;
    }

    public function hasPublicProperty(): bool
    {
        return $this->publicProperty !== '';
    }
}