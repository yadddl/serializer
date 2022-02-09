<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Serializers;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Yadddl\Serializer\Registry\SerializerRegistryImpl;
use Yadddl\ValueObject\Primitive\Integer;
use Yadddl\ValueObject\Primitive\Text;

class ObjectSerializerImplTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function test(mixed $value, mixed $expectedResult): void
    {
        $serializer = new ObjectSerializerImpl(SerializerRegistryImpl::make([
            Integer::class => new IntegerSerializer()
        ]));

        $result = $serializer($value);

        Assert::assertSame($expectedResult, $result);
    }

    public function dataProvider()
    {
        yield 'stringable' => [new Text('this is a test'), 'this is a test'];
        yield 'integer' => [Integer::create(10), 10];
    }
}
