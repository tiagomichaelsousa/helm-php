<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm\Models;

class Repository
{
    public function __construct(
        public string $name,
        public string $url
    ) {
    }
}
