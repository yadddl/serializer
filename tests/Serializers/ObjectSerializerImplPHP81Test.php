<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Serializers;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

if (\PHP_VERSION_ID >= 80100) {

    class ObjectSerializerImplPHP81Test extends TestCase
    {
        public function test_enum(): void
        {
            $serializer = new ObjectSerializerImpl();

            Assert::assertSame('€', $serializer(Currency::EURO));
            Assert::assertSame('$', $serializer(Currency::DOLLAR));
            Assert::assertSame('£', $serializer(Currency::POUND));
            Assert::assertSame('North', $serializer(Orientation::North));
            Assert::assertSame('South', $serializer(Orientation::South));
            Assert::assertSame('West', $serializer(Orientation::West));
            Assert::assertSame('East', $serializer(Orientation::East));
        }
    }


    enum Orientation
    {
        case North;
        case South;
        case West;
        case East;

    };

    enum Currency: string
    {
        case EURO = '€';
        case DOLLAR = '$';
        case POUND = '£';
    };
}
