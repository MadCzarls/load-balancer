<?php

declare(strict_types=1);

namespace App\Tests\Algorithm;

use App\Algorithm\RoundRobin;
use App\Host\HostInterface;
use PHPUnit\Framework\TestCase;

final class RoundRobinTest extends TestCase
{
    public function testGetHost(): void
    {
        $hostFirst = $this->createStub(HostInterface::class);
        $hostSecond = $this->createStub(HostInterface::class);

        $algorithm = new RoundRobin([
            $hostFirst,
            $hostSecond,
        ]);
        $this->assertSame($hostFirst, $algorithm->getHost());
    }

    public function testGetHostIterationStartsFromBeginning(): void
    {
        $hostFirst = $this->createStub(HostInterface::class);
        $hostSecond = $this->createStub(HostInterface::class);

        $algorithm = new RoundRobin([
            $hostFirst,
            $hostSecond,
        ]);

        $this->assertSame($hostFirst, $algorithm->getHost());
        $this->assertSame($hostSecond, $algorithm->getHost());
        $this->assertSame($hostFirst, $algorithm->getHost());
    }

    public function testGetHostIterationStartsFromBeginningForOneHost(): void
    {
        $hostFirst = $this->createStub(HostInterface::class);

        $algorithm = new RoundRobin([$hostFirst]);

        $this->assertSame($hostFirst, $algorithm->getHost());
        $this->assertSame($hostFirst, $algorithm->getHost());
        $this->assertSame($hostFirst, $algorithm->getHost());
    }
}
