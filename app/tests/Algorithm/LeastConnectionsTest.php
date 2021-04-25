<?php

declare(strict_types=1);

namespace App\Tests\Algorithm;

use App\Algorithm\LeastConnections;
use App\Host\HostInterface;
use PHPUnit\Framework\TestCase;

class LeastConnectionsTest extends TestCase
{
    public function testGetHostPicksOneWithLoadLowerThanThreshold(): void
    {
        $hostFirst = $this->createStub(HostInterface::class);

        $hostFirst
            ->method('getLoad')
            ->willReturn(0.8);

        $hostSecond = $this->createStub(HostInterface::class);
        $hostSecond
            ->method('getLoad')
            ->willReturn(0.7);

        $algorithm = new LeastConnections([$hostFirst, $hostSecond]);
        $this->assertSame($hostSecond, $algorithm->getHost());
    }

    public function testGetHostPicksOneWithLowestLoadIfAllHostsHasLoadAboveThreshold(): void
    {
        $hostFirst = $this->createStub(HostInterface::class);

        $hostFirst
            ->method('getLoad')
            ->willReturn(0.8);

        $hostSecond = $this->createStub(HostInterface::class);
        $hostSecond
            ->method('getLoad')
            ->willReturn(0.77);

        $hostThird = $this->createStub(HostInterface::class);
        $hostThird
            ->method('getLoad')
            ->willReturn(0.9);

        $algorithm = new LeastConnections([$hostFirst, $hostSecond, $hostThird]);
        $this->assertSame($hostSecond, $algorithm->getHost());
    }
}
