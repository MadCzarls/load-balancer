<?php

declare(strict_types=1);

namespace App\Algorithm;

use App\Host\HostInterface;

class LeastConnections extends AbstractAlgorithm
{
    private const LOAD_THRESHOLD = 0.75;

    public function getHost(): HostInterface
    {
        $currentLowestThresholdHold = $this->hosts[0];
        foreach ($this->hosts as $host) {
            if ($host->getLoad() <= self::LOAD_THRESHOLD) {
                return $host;
            }

            if ($host->getLoad() >= $currentLowestThresholdHold->getLoad()) {
                continue;
            }

            $currentLowestThresholdHold = $host;
        }

        return $currentLowestThresholdHold;
    }
}
