<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm\Commands;

use Illuminate\Support\Collection;
use Symfony\Component\Process\Process;
use tiagomichaelsousa\Helm\Models\Release;

class ReleaseCommand
{
    private Collection $releases;

    public function __construct()
    {
        $this->boot();
    }

    private function boot(): ReleaseCommand
    {
        $process = new Process(['helm', 'list', '-o', 'json']);
        $process->run();

        $this->releases = collect(json_decode($process->getOutput()))
            ->map(fn ($release) => new Release(
                $release->name,
                $release->chart,
                $release->app_version,
                $release->namespace,
                $release->revision,
                $release->status,
                $release->updated,
            ));

        return $this;
    }

    public function whereName(string $name) : self
    {
        return $this->filterWhere('name', $name);
    }

    private function filterWhere($name, $filter) : self
    {
        $this->releases = $this->releases->where($name, $filter);

        return $this;
    }

    public function whereChart(string $chart) : self
    {
        return $this->filterWhere('chart', $chart);
    }

    public function whereAppVersion(string $appVersion) : self
    {
        return $this->filterWhere('appVersion', $appVersion);
    }

    public function whereNamespace(string $namespace) : self
    {
        return $this->filterWhere('namespace', $namespace);
    }

    public function whereStatus(string $status) : self
    {
        return $this->filterWhere('status', $status);
    }

    public function get(): self
    {
        return $this->releases;
    }
}
