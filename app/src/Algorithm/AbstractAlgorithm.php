<?php

declare(strict_types=1);

namespace App\Algorithm;

use App\Host\HostInterface;
use Webmozart\Assert\Assert;

abstract class AbstractAlgorithm implements LoadBalancingAlgorithmInterface
{
    /** @var HostInterface[] */
    protected array $hosts;

    /**
     * @param HostInterface[] $hosts
     */
    public function __construct(array $hosts)
    {
        Assert::notEmpty($hosts);
        Assert::allIsInstanceOf($hosts, HostInterface::class);
        $this->hosts = $hosts;
    }
}
