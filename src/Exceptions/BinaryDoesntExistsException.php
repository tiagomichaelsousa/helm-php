<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm\Exceptions;

use InvalidArgumentException;
use Symfony\Component\Console\Exception\ExceptionInterface;

/**
 * @internal
 */
final class BinaryDoesntExistsException extends InvalidArgumentException implements ExceptionInterface
{
    /**
     * Creates a new instance of binary doesnt exists exception.
     */
    public function __construct(string $path)
    {
        parent::__construct(sprintf('The binary for helm do not exists in path `%s`.', $path));
    }
}
