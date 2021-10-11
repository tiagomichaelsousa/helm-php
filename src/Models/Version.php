<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm\Models;

class Version
{
    public function __construct(
        public string $version,
        public string $gitCommit,
        public string $gitTreeState,
        public string $goVersion,
    ) {
    }
}
