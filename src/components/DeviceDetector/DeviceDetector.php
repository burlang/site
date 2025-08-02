<?php

declare(strict_types=1);

namespace app\components\DeviceDetector;

use Detection\MobileDetect;

class DeviceDetector implements DeviceDetectorInterface
{
    private MobileDetect $mobileDetect;

    public function __construct(MobileDetect $mobileDetect)
    {
        $this->mobileDetect = $mobileDetect;
    }

    public function isMobile(): bool
    {
        return $this->mobileDetect->isMobile();
    }

    public function isDesktop(): bool
    {
        return !$this->isMobile();
    }
}
