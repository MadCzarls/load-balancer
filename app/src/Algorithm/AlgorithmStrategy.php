<?php

declare(strict_types=1);

namespace App\Algorithm;

use App\Host\HostInterface;
use InvalidArgumentException;
use ReflectionClass;

final class AlgorithmStrategy
{
    private const VARIANT_ROUND_ROBIN = 1;
    private const VARIANT_LEAST_CONNECTIONS = 2;

    private function __construct()
    {
    }

    /**
     * @return int[]
     */
    public static function getVariants(): array
    {
        $class = new ReflectionClass(self::class);

        return $class->getConstants();
    }

    /**
     * @param HostInterface[] $hosts
     */
    public static function createAlgorithm(int $variant, array $hosts): LoadBalancingAlgorithmInterface
    {
        switch ($variant) {
            case self::VARIANT_ROUND_ROBIN:
                return new RoundRobin($hosts);

            case self::VARIANT_LEAST_CONNECTIONS:
                return new LeastConnections($hosts);

            default:
                throw new InvalidArgumentException('Unknown load balancing variant');
        }
    }
}
