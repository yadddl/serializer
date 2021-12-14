# Configuration

Not always the basic configuration is enough. If you need to customize the serializer with your own classes, then you should create your own factory.

You can choose two ways to write a custom serializer. You can implements the `Serializer` interface: 
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
