<?php

declare(strict_types=1);

namespace App\Algorithm;

use App\Host\HostInterface;

interface LoadBalancingAlgorithmInterface
{
    public function getHost(): HostInterface;
}
