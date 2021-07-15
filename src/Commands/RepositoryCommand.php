<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm\Commands;

use Illuminate\Support\Collection;
use Symfony\Component\Process\Process;
use tiagomichaelsousa\Helm\Exceptions\RepositoryDoesntExistsException;
use tiagomichaelsousa\Helm\Models\Repository;

final class RepositoryCommand
{
    public function add(Repository $repository): Repository
    {
        if ($this->find($repository)) {
            throw new RepositoryDoesntExistsException($repository);
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
            ->map(fn($repository) => new Repository($repository->name, $repository->url))
            ->firstWhere('name', $repository->name);
    }

    /** @phpstan-ignore-next-line */
    public function list(): Collection
    {
        $process = new Process(['helm', 'repo', 'list', '-o', 'json']);
        $process->run();
        
        return collect(json_decode($process->getOutput()))
            ->map(fn($repository) => new Repository($repository->name, $repository->url));
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
}
