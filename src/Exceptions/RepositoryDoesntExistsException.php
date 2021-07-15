<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm\Exceptions;

use InvalidArgumentException;
use Symfony\Component\Console\Exception\ExceptionInterface;
use tiagomichaelsousa\Helm\Models\Repository;

/**
 * @internal
 */
final class RepositoryDoesntExistsException extends InvalidArgumentException implements ExceptionInterface
{
    /**
     * Creates a new instance of binary doesnt exists exception.
     */
    public function __construct(Repository $repository)
    {
        parent::__construct(sprintf('The repository `%s` from `%s` doesnt exists.', $repository->name, $repository->url));
    }
}
