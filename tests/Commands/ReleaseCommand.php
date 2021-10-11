<?php

use Illuminate\Support\Collection;
use Tests\Factories\ReleaseFactory;
use tiagomichaelsousa\Helm\Commands\ReleaseCommand;
use tiagomichaelsousa\Helm\HelmClient;

it('retrieves the default path for helm client', function () {
    $client = HelmClient::releases();

    expect($client)->toBeInstanceOf(Collection::class);
});

it('test', function () {
    $release = (new ReleaseFactory())->create();

    $mock = mock(ReleaseCommand::class)->expect(
        withNamespace: fn($name) => collection($release),
    );

    expect($mock->withNamespace('Nuno'))->toHaveCount(1);
})->only();
