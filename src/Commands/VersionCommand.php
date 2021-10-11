<?php

declare(strict_types=1);

namespace tiagomichaelsousa\Helm\Commands;

use Symfony\Component\Process\Process;
use tiagomichaelsousa\Helm\Models\Version;

class VersionCommand
{
    public function get(): Version
    {
        $process = new Process(['helm', 'version', '--template', '{{.Version}},{{.GitCommit}},{{.GitTreeState}},{{.GoVersion}}']);
        $process->run();

        [$version, $gitCommit, $gitTreeState, $goVersion] = explode(',', $process->getOutput());

        return new Version($version, $gitCommit, $gitTreeState, $goVersion);
    }
}
