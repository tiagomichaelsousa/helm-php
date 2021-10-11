<?php

use tiagomichaelsousa\Helm\HelmClient;
use tiagomichaelsousa\Helm\Models\Version;

it('retrieves the default path for helm client', function () {
    $client = HelmClient::version()->get();

    expect($client)->toBeInstanceOf(Version::class);
});
