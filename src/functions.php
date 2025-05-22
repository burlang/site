<?php

declare(strict_types=1);

function env(string $name, ?string $default = null): string
{
    $value = false;
    if (isset($_ENV[$name])) {
        $value = $_ENV[$name];
        if (is_int($value) || is_string($value)) {
            return (string)$value;
        }
        throw new RuntimeException(sprintf('Invalid env: "%s"', $name));
    }

    if ($default !== null) {
        return $default;
    }

    throw new RuntimeException(sprintf('Undefined env: "%s"', $name));
}
