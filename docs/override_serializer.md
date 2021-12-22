# Override the configuration

The `SerializerRegistryImpl` doesn't allow registering multiple serializer for the same class but playing with polymorphism could be very helpful.

Given a standard configuration
```php
$registry->register(Integer::class, new IntegerSerializer());
```
Then if you extend an `Integer`, the standard serializer will be used without any further configuration.
```php
class Temperature extends Integer {}
```
But if you need something more specific, custom, you can register a new serializer.
```php
$registry->register(Temperature::class, fn(Temperature $value): string => $value . ' °C');
```


