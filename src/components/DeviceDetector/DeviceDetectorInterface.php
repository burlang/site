<?php

declare(strict_types=1);

namespace app\components\DeviceDetector;

interface DeviceDetectorInterface
{
    public function isMobile(): bool;

    public function isTablet(): bool;

    public function isDesktop(): bool;
}
