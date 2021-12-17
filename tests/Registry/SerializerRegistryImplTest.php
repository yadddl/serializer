<?php

declare(strict_types=1);

namespace Yadddl\Serializer\Registry;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Yadddl\Serializer\Registry\SerializerRegistryImpl
 */
class SerializerRegistryImplTest extends TestCase
{
    public function test(): void
    {
        $registry = new SerializerRegistryImpl();

        $expectedOutput = random_int(1, 123456789);
        $className = Foo::class;

        $registry->register($className, fn () => $expectedOutput );

        $serializer = $registry->serializerFor($className);

        Assert::assertNotNull($serializer);
        Assert::assertSame($expectedOutput, $serializer('aaa'));
    }
}

class Foo {

}