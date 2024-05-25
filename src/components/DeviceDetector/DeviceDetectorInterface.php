<?php

namespace app\components\DeviceDetector;

interface DeviceDetectorInterface
{
    public function isMobile(): bool;

    public function isTablet(): bool;

    public function isDesktop(): bool;
}
