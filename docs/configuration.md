# Configuration

Following conventions is good for almost every case. Almost. But if you need to serialize your own object in a special
way, you can add custom serializers and that's it. You just need to implement your own Serializer Factory.

```php
use Yadddl\Serializer\Registry\SerializerRegistryImpl;

class MyCustomSerializerFactory implements SerializerFactory
{
    public function __invoke(): Serializer
    {
        $registry = new SerializerRegistryImpl();
        
        $registry->register(/* registring your custom serializers */);

        return new SerializerImpl(
            new IterableSerializerImpl(), 
            new ObjectSerializerImpl($registry)
        );
    }
}
```

And there are two ways to registry a custom serializer: 

## Implementing the `Serializer` interface:

```php
use Yadddl\Serializer\Serializer;

/**
 * @extends Serializer<Integer, int>
 */
class IntegerSerializer implements Serializer
{
    public function __invoke(mixed $object): mixed
    {
        assert(
            $object instanceof Integer, 
            sprintf('Object cannot be serialized. Expecting "%s", found "%s"', Integer::class, $object::class)
        );

        return $object->toInt();
    }
}
````
And then
```php
$registry->register(Integer::class, new IntegerSerializer())
```

## Closure serializer

```php
$integerSerializer = fn (Integer $integer) => $integer->toInt());

$registry->register(Integer::class, $integerSerializer)
```
Alternatively, you can put everything  inline

```php
$registry->register(Integer::class, fn (Integer $integer) => $integer->toInt());
```
