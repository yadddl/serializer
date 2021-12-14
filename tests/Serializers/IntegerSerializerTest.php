<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Serializers;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Yadddl\ValueObject\Primitive\Date;
use Yadddl\ValueObject\Primitive\Integer;

/**
 * @covers \Yadddl\Serializer\Serializers\IntegerSerializer
 */
class IntegerSerializerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldSerialize(): void
    {
        $value = 42;

        $serializer = new IntegerSerializer();

        Assert::assertSame($value, $serializer(Integer::create($value)));
    }

    /**
     * @test
     */
    public function shouldBroke(): void {
        $this->expectException(\Error::class);

        $serializer = new IntegerSerializer();

        $serializer(Date::now());
    }
}
