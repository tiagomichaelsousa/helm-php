<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm;

use tiagomichaelsousa\Helm\Commands\RepositoryCommand;
use tiagomichaelsousa\Helm\Commands\PathRepository;

final class HelmClient
{
    /**
     * The process instance to run Helm from.
     *
     * @var \Symfony\Component\Process\Process
     */
    protected $process;

    public static function path(): PathRepository
    {
        return new PathRepository();
    }

    public static function repository(): RepositoryCommand
    {
        return new RepositoryCommand();
    }
}
