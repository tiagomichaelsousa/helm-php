<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm;

use tiagomichaelsousa\Helm\Commands\PathRepository;
use tiagomichaelsousa\Helm\Commands\RepositoryCommand;

final class HelmClient
{
    public static function path(): PathRepository
    {
        return new PathRepository();
    }

    public static function repository(): RepositoryCommand
    {
        return new RepositoryCommand();
    }
}
