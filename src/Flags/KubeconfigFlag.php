<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm\Flags;

use tiagomichaelsousa\Helm\Interfaces\FlagInterface;

class KubeconfigFlag implements FlagInterface
{
    public const FLAG = '--kubeconfig';
    private string $kubeconfigPath;

    public function __construct(string $kubeconfigPath)
    {
        $this->kubeconfigPath = $kubeconfigPath;
    }

    public function handle()
    {
        return self::FLAG . '=' . $this->kubeconfigPath;
    }
}
