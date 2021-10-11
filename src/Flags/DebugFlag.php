<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm\Flags;

use tiagomichaelsousa\Helm\Interfaces\FlagInterface;

class DebugFlag implements FlagInterface
{
    public const FLAG = '--debug';

    public function handle()
    {
        return self::FLAG;
    }
}
