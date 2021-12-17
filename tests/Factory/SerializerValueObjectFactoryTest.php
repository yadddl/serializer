<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Factory;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Yadddl\Serializer\Serializer;
use Yadddl\Serializer\Serializers\SerializerImpl;
use Yadddl\ValueObject\Primitive\Date;
use Yadddl\ValueObject\Primitive\DateTime;
use Yadddl\ValueObject\Primitive\Integer;
use Yadddl\ValueObject\Primitive\Text;
use Yadddl\ValueObject\Primitive\Time;

/**
 * @covers \Yadddl\Serializer\Factory\SerializerValueObjectFactory
 */
class SerializerValueObjectFactoryTest extends TestCase
{

    private Serializer $serializer;

    public function dataProvider()
    {
        yield 'integer' => [Integer::create(1), 1];
        yield 'text' => [Text::create('Hello'), 'Hello'];
        yield 'date_time' => [DateTime::create('2021-01-01 01:02:03'), '2021-01-01 01:02:03'];
        yield 'date' => [Date::create('2021-01-01'), '2021-01-01'];
        yield 'time' => [Time::fromString('01:02:03'), '01:02:03'];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->serializer =  SerializerValueObjectFactory::make();
    }

    /**
     * @test
     * @dataProvider dataProvider
     */
    public function shouldSerializeStuff(object $valueObject, mixed $expectedResult) {

        Assert::assertSame($expectedResult, ($this->serializer)($valueObject));
    }
}
