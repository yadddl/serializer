# Conventions
We think that following conventions speeds up the developing time. Of course, sometimes it's not the best option, but if it fit almost all of your use case, why not?

So, if you'll follow those conventions, you can use the serializer without any configuration at all:

1) If the class has both a private property and a public getter, then it will serialize the property
2) If the class has both a private property and an hasser / isser, then it will serialize the property as a boolean
3) If the class has a getter / hasser / isser but not the property, then it will NOT serialize the property at all
4) If the property is private / protected and hasn't any getter / isser / hasser, then it wil NOT serialized
5) If the property is public, without any accessor, then it will serialized
6) The class could implement the `__toString` method

## Edge cases
- If there's a **public property** and an **hasser**, then the **hasser** won
- If there's a **getter** and an **hasser**, then the **getter** won
- If there's a **getter** and a **public property**, then the **getter** won

`public property < hasser < getter/isser`



> **NOTE**: Behind the scene there is the `symfony/property-access` package, this means that the serializer follows the same access rule and behaviour of that package.