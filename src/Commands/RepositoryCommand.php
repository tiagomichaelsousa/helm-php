<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm\Commands;

use Illuminate\Support\Collection;
use Symfony\Component\Process\Process;
use tiagomichaelsousa\Helm\Exceptions\RepositoryAlreadyExistsException;
use tiagomichaelsousa\Helm\Exceptions\RepositoryDoesntExistsException;
use tiagomichaelsousa\Helm\Models\Repository;

class RepositoryCommand
{
    public array $flags = [];

    public function add(Repository $repository): Repository
    {
        if ($this->find($repository)) {
            throw new RepositoryAlreadyExistsException($repository);
        }

        $process = new Process(['helm', 'repo', 'add', $repository->name, $repository->url]);

        $process->run();

        return $repository;
    }

    public function find(Repository $repository): ?Repository
    {
        $process = new Process(['helm', 'repo', 'list', '-o', 'json']);
        $process->run();

        return collect(json_decode($process->getOutput()))
            ->map(fn ($repository) => new Repository($repository->name, $repository->url))
            ->firstWhere('name', $repository->name);
    }

    /** @phpstan-ignore-next-line */
    public function list(): Collection
    {
        $process = new Process(['helm', 'repo', 'list', '-o', 'json', ...$this->flags]);
        $process->run();

        return collect(json_decode($process->getOutput()))
            ->map(fn ($repository) => new Repository($repository->name, $repository->url));
    }

    public function remove(Repository $repository): Repository
    {
        if (!$this->find($repository)) {
            throw new RepositoryDoesntExistsException($repository);
        }

        $process = new Process(['helm', 'repo', 'remove', $repository->name]);
        $process->run();

        return $repository;
    }

    public function withFlags(array $flags)
    {
        collect($flags)
            ->each(fn ($flag, $value) => $this->withFlag($value, $flag));

        return $this;
    }

    public function withFlag($flag, $value = null)
    {
        $this->flags[] = (new $flag($value))->handle();

        return $this;
    }
}
