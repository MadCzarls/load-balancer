<?php

declare(strict_types=1);

namespace App\Host;

use App\Request\Request;

interface HostInterface
{
    public function getLoad(): float;

    public function handleRequest(Request $request): void;
}
