# Yet Another Serializer Library (YASL)
## by Yet Another DDD Library (YADDDL)

This library implements a serializer, and it follows those rules:

- **Do not use extra metadata:** the PHP language is expressive enough to give you everything you need.


- **Convention over configuration:** just configure what differ from the standard use case, that already cover the majority of the cases.

It goes in-pair with the [Value Object](https://github.com/yadddl/value-object) project of the same family, but could be used alone. Just be sure to follow the [conventions](docs/conventions.md)!

It doesn't cover all the possibile use cases, then use it if you want, or contribute if you like what we are doing and want to expand it.

## Usage
    composer require yadddl/serializer

## Getting started
Given a simple DTO
```php
class SillyDTO {
    public function __construct(
        private string $propertyOne,
        private int $propertyTwo, 
        private string $hiddenProperty 
    ) {}
    
    public function getPropertyOne(): string 
    { 
        return $this->propertyOne; 
    }
    
    public function getPropertyTwo(): int 
    { 
        return $this->propertyTwo; 
    } 
}
```
The easy way to serialize it is this one

```php
use Yadddl\Serializer\Factory\SerializerBaseFactory;

// Fastest way to create a basic serializer
$serializer = SerializerBaseFactory::make();

$dto = new SillyDTO('one', 2, 'hidden');

$data = $serializer->serialize($dto);


echo json_encode($data, JSON_PRETTY_PRINT);
```
And the resulting json
```json
{
    "propertyOne": "one",
    "propertyTwo": 2
}
```

## Documentation
- [Conventions](docs/conventions.md)
- [Configuration](docs/configuration.md)
- [Override a serializer](docs/override_serializer.md)