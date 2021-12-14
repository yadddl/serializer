<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Serializers;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Yadddl\ValueObject\Primitive\Date;
use Yadddl\ValueObject\Primitive\DateTime;

/**
 * @covers \Yadddl\Serializer\Serializers\DateTimeSerializer
 */
class DateTimeSerializerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldSerialize(): void {
        $serializer = new DateTimeSerializer();

        $dateTimeAsString = '2021-10-10 12:13:14';

        $dateTime = DateTime::createFromString($dateTimeAsString);

        Assert::assertSame($dateTimeAsString, $serializer($dateTime));
    }

    /**
     * @test
     */
    public function shouldBroke(): void {
        $this->expectException(\Error::class);

        $serializer = new DateTimeSerializer();

        $serializer(Date::now());
    }
}
