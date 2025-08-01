<?php

declare(strict_types=1);

use yii\console\Application as ConsoleApplication;
use yii\helpers\StringHelper;
use yii\web\Application as WebApplication;

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

function app(): ConsoleApplication|WebApplication
{
    return Yii::$app;
}

function webApp(): WebApplication
{
    if (app() instanceof WebApplication) {
        return app();
    }
    throw new RuntimeException('This function can only be used in a web application context.');
}

function consoleApp(): ConsoleApplication
{
    if (app() instanceof ConsoleApplication) {
        return app();
    }
    throw new RuntimeException('This function can only be used in a console application context.');
}

function alias(string $value): string
{
    return Yii::getAlias($value);
}

function can(string $permission): bool
{
    return webApp()->user->can($permission);
}

function isGuest(): bool
{
    return webApp()->user->isGuest;
}

function formatDate(null|DateTime|DateTimeInterface|int|string $value, ?string $format = null): string
{
    return app()->formatter->asDate($value, $format);
}

function isRouteActive(string $targetRoute): bool
{
    $route = app()->controller->getRoute();
    return $route === $targetRoute;
}

function isRoutePrefixActive(string $routePrefix): bool
{
    $route = app()->controller->getRoute();
    return StringHelper::startsWith($route, $routePrefix);
}
