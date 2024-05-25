<?php

declare(strict_types=1);

function env(string $name, ?string $default = null)
{
    $value = false;
    if (isset($_ENV[$name])) {
        $value = $_ENV[$name];
    }

    if ($value !== false) {
        return $value;
    }

    if ($default !== null) {
        return $default;
    }

    throw new RuntimeException(sprintf('Undefined env: "%s"', $name));
}
