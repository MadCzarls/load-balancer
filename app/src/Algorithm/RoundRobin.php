<?php

declare(strict_types=1);

namespace App\Algorithm;

use App\Host\HostInterface;

use function count;

class RoundRobin extends AbstractAlgorithm
{
    private int $currentHostIndex = 0;

    public function getHost(): HostInterface
    {
        $host = $this->hosts[$this->currentHostIndex];

        if (count($this->hosts) - 1 === $this->currentHostIndex) {
            $this->currentHostIndex = 0;
        } else {
            $this->currentHostIndex++;
        }

        return $host;
    }
}
