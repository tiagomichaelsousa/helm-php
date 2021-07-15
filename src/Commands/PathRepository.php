<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm\Commands;

use tiagomichaelsousa\Helm\Exceptions\BinaryDoesntExistsException;

final class PathRepository
{
    private string $path;

    /**
     * Creates a new instance of the test suite.
     */
    public function __construct()
    {
        $this->path = '/usr/local/bin/helm';
    }

    /**
     * Sets the path for helm binary.
     */
    public function set(string $path): PathRepository
    {
        if (!file_exists($path)) {
            throw new BinaryDoesntExistsException($path);
        }

        $this->path = $path;

        return $this;
    }

    /**
     * Gets the path for helm binary.
     */
    public function get(): string|null
    {
        return $this->path ?? null;
    }
}
