# Conventions
The serializer works following conventions (like: if it has a getter, than )

* A class property could be private/protected or public
  * If public, then it is writable/readable
  * If private/protected, there's need a getter/isser/hasser to be accessed, otherwise it's hidden
  > ***NOTE:*** *Immutable object are good things, try to avoid use public properties*
*  A class could have a `__toString` method   


Since internal it is used the property-access package, it follow