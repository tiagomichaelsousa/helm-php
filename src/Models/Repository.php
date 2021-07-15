<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm\Models;

class Repository
{
    public string $name;
    public string $url;

    public function __construct(string $name, string $url)
    {
        $this->name = $name;
        $this->url  = $url;
    }
}
