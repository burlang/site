<?php

declare(strict_types=1);

namespace app\components\DeviceDetector;

use Detection\MobileDetect;

class DeviceDetector implements DeviceDetectorInterface
{
    private bool $isTablet;
    private bool $isMobile;
    private bool $isDesktop;

    public function __construct()
    {
        $mobileDetect = new MobileDetect();
        $this->isMobile = $mobileDetect->isMobile();
        $this->isTablet = $mobileDetect->isTablet();
        $this->isDesktop = !$mobileDetect->isMobile();
    }

    public function isMobile(): bool
    {
        return $this->isMobile;
    }

    public function isTablet(): bool
    {
        return $this->isTablet;
    }

    public function isDesktop(): bool
    {
        return $this->isDesktop;
    }
}
