<?php

//declare(strict_types=1);

if (\PHP_VERSION_ID >= 80100) {
    return;
}

if (!interface_exists('UnitEnum')) {
    interface UnitEnum
    {
    }
}

if (!interface_exists('BackedEnum')) {
    interface BackedEnum extends UnitEnum
    {
    }
}