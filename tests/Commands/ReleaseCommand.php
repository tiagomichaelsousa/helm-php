<?php

use Illuminate\Support\Collection;
use Tests\Factories\ReleaseFactory;
use tiagomichaelsousa\Helm\Commands\ReleaseCommand;
use tiagomichaelsousa\Helm\HelmClient;

it('retrieves the default path for helm client', function () {
    $client = HelmClient::releases();

    expect($client)->toBeInstanceOf(Collection::class);
});
