<?php

declare(strict_types=1);

namespace App\Tests;

use App\Algorithm\AlgorithmStrategy;
use App\Host\HostInterface;
use App\LoadBalancer;
use App\Request\Request;
use PHPUnit\Framework\TestCase;

class LoadBalancerTest extends TestCase
{
    public function testConstructThrowsExceptionIfVariantNotSupported(): void
    {
        $this->expectExceptionMessage('Expected one of: 1, 2. Got: 3');

        $hostFirst = $this->createStub(HostInterface::class);
        $hostSecond = $this->createStub(HostInterface::class);

        $notSupportedVariant = 3;

        new LoadBalancer([$hostFirst, $hostSecond], $notSupportedVariant);
    }

    public function testHandleRequest(): void
    {
        $request = $this->createStub(Request::class);

        $hostFirst = $this->createMock(HostInterface::class);
        $hostSecond = $this->createMock(HostInterface::class);

        $hostFirst->expects($this->exactly(2))->method('handleRequest')->with($request);

        foreach (AlgorithmStrategy::getVariants() as $variant) {
            $loadBalancer = new LoadBalancer([$hostFirst, $hostSecond], $variant);
            $loadBalancer->handleRequest($request);
        }
    }
}
