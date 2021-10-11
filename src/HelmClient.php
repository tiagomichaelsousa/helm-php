<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm;

use tiagomichaelsousa\Helm\Commands\PathRepository;
use tiagomichaelsousa\Helm\Commands\ReleaseCommand;
use tiagomichaelsousa\Helm\Commands\RepositoryCommand;
use tiagomichaelsousa\Helm\Commands\VersionCommand;

class HelmClient
{
    public static function path(): PathRepository
    {
        return new PathRepository();
    }

    public static function repository(): RepositoryCommand
    {
        return new RepositoryCommand();
    }

    public static function releases(): ReleaseCommand
    {
        return new ReleaseCommand();
    }
}
