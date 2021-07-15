<?php

use tiagomichaelsousa\Helm\Exceptions\BinaryDoesntExistsException;
use tiagomichaelsousa\Helm\HelmClient;

it('retrieves the default path for helm client', function () {
    $client = HelmClient::path()->get();

    expect($client)->toBe('/usr/local/bin/helm');
});

it('allows to set the default path for helm client binary', function () {
    $path = HelmClient::path()->set('/usr/local/Cellar/helm@2/2.17.0');

    expect($path->get())->toBe('/usr/local/Cellar/helm@2/2.17.0');
});

it('throws an exception if the path for the binary doesnt exists', function () {
    HelmClient::path()->set('/usr/bin/helm/non-existent-binary');
})->throws(BinaryDoesntExistsException::class);
