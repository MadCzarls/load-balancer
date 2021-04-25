<?php

declare(strict_types=1);

namespace App\Tests\Algorithm;

use App\Algorithm\AbstractAlgorithm;
use App\Host\HostInterface;
use App\Request\Request;
use PHPUnit\Framework\TestCase;
use Webmozart\Assert\InvalidArgumentException;

final class AbstractAlgorithmTest extends TestCase
{
    public function testConstructor(): void
    {
        $hosts = [
            $this->createStub(HostInterface::class),
        ];

        $this->getMockBuilder(AbstractAlgorithm::class)->setConstructorArgs([$hosts])->getMockForAbstractClass();

        $this->expectNotToPerformAssertions();
    }

    public function testExceptionThrownIfHostNotInstanceOfAlgorithmInterface(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $hosts = [
            $this->createStub(HostInterface::class),
            new Request(),
        ];

        $this->getMockBuilder(AbstractAlgorithm::class)->setConstructorArgs([$hosts])->getMockForAbstractClass();
    }

    public function testExceptionThrownIfHostsEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $hosts = [];

        $this->getMockBuilder(AbstractAlgorithm::class)->setConstructorArgs([$hosts])->getMockForAbstractClass();
    }
}
