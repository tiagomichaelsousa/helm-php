<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm\Models;

use Carbon\Carbon;

class Release
{
    public string $name;
    public string $chart;
    public string $appVersion;
    public string $namespace;
    public string $revision;
    public string $status;
    public Carbon $updated;

    public function __construct(
        string $name,
        string $chart,
        string $appVersion,
        string $namespace,
        string $revision,
        string $status,
        string $updated,
    ) {
        $this->name       = $name;
        $this->chart      = $chart;
        $this->appVersion = $appVersion;
        $this->namespace  = $namespace;
        $this->revision   = $revision;
        $this->status     = $status;
        $this->updated    = Carbon::parse($updated);
    }
}
