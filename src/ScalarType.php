<?php

declare(strict_types=1);

namespace Serens\TypedCollection;

enum ScalarType: string
{
    case ARRAY = 'array';
    case BOOL = 'boolean';
    case DOUBLE = 'double';
    case INT = 'integer';
    case STRING = 'string';
    case OBJECT = 'object';
    case CALLABLE = 'callable';
}
