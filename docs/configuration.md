# Configuration

Following conventions is good for almost every case. Almost. But if you need to serialize your own object in a special
way, you can add custom serializers and that's it. You just need to implement your own Serializer Factory.

```php
class MyCustomSerializerFactory implements SerializerFactory
{
    public function __invoke(): Serializer
    {
        $registry = new SerializerRegistryImpl();
        
        $registry
        $registry->register(Integer::class, new IntegerSerializer());
        $registry->register(DateTime::class, new DateTimeSerializer());

        return new SerializerImpl(
            new IterableSerializerImpl(), 
            new ObjectSerializerImpl($registry)
        );
    }
}
```

And there are two ways to write a custom serializer. You can implements the `Serializer` interface:

```php
use Yadddl\Serializer\Serializer;

class IntegerSerializer implements Serializer
{
    public function serialize(mixed $object): mixed
    {
        assert($object instanceof Integer, "Object cannot be serialized");

        return $object->toInt();
    }
}
````

Or just use a closure:

```php
$integerSerializer = fn (Integer $integer) => $integer->toInt());
```

And then

```php
use Yadddl\Serializer\SerializerConfig;use Yadddl\Serializer\Serializers\SerializerImpl;

$config = new SerializerConfig();

// Using the class
$config->serializeWith(Integer::class, new IntegerSerializer());

// Or using the  closure
$config->serialize(Integer::class)
       ->with($integerSerializer);
      

return new SerializerImpl($config);
```
