<?php

namespace Tests\Factories;

use Carbon\Carbon;
use tiagomichaelsousa\Helm\Models\Release;
use function Pest\Faker\faker;

class ReleaseFactory
{
    public function create(array $params = []): Release
    {
        return new Release(...$this->data($params));
    }

    private function data(?array $params)
    {
        return array_merge(
            [
                'name' => faker()->word,
                'chart' => faker()->word . '-chart',
                'appVersion' => '1.0.' . faker()->numberBetween(0, 20),
                'namespace' => faker()->word . '-namespace',
                'revision' => faker()->numberBetween(0, 20),
                'status' => faker()->randomElement(['unknown', 'deployed', 'uninstalled', 'superseded', 'failed', 'uninstalling', 'pending-install', 'pending-upgrade', 'pending-rollback']),
                'updated' => Carbon::now()->toString(),
            ],
            $params,
        );
    }

    public function make(?array $params)
    {
        return $this->data($params);
    }
}
