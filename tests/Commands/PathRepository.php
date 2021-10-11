<?php

use tiagomichaelsousa\Helm\Exceptions\BinaryDoesntExistsException;
use tiagomichaelsousa\Helm\HelmClient;

it('retrieves the default path for helm client', function () {
    $client = HelmClient::path()->get();

    expect($client)->toBe('/usr/local/bin/helm');
});

it('allows to set the default path for helm client binary', function () {
    $binary = __DIR__ . '/../tests/Mocks/HelmClient';
    $path = HelmClient::path()->set($binary);

    expect($path->get())->toBe($binary);
})->skip();

it('throws an exception if the path for the binary doesnt exists', function () {
    HelmClient::path()->set('/usr/bin/helm/non-existent-binary');
})->throws(BinaryDoesntExistsException::class)->skip();
