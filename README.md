# Exposer [![CircleCI](https://circleci.com/gh/polass/exposer.svg?style=svg)](https://circleci.com/gh/polass/exposer)

The Exposer exposes hidden properties and methods.

## Usage

```php
<?php

class Secrecy {
    private $property = 'hidden';

    private function method($argument) {
        return 'called';
    }
}

$exposer = expose(new Secrecy);

echo $exposer->property;  // `hidden`

$exposer->property = 'exposed';
echo $exposer->property;  // `exposed`

echo $exposer->method('argument');  // `called`
```
