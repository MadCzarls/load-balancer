<?php

declare(strict_types=1);

namespace App;

use App\Algorithm\AlgorithmStrategy;
use App\Algorithm\LoadBalancingAlgorithmInterface;
use App\Host\HostInterface;
use App\Request\Request;
use Webmozart\Assert\Assert;

class LoadBalancer
{
    private LoadBalancingAlgorithmInterface $algorithm;

    /**
     * @param HostInterface[] $hosts
     */
    public function __construct(array $hosts, int $variant)
    {
        Assert::inArray($variant, AlgorithmStrategy::getVariants());
        $this->algorithm = AlgorithmStrategy::createAlgorithm($variant, $hosts);
    }

    public function handleRequest(Request $request): void
    {
        $this->algorithm->getHost()->handleRequest($request);
    }
}
