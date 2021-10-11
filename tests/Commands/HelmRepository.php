<?php

use tiagomichaelsousa\Helm\Exceptions\RepositoryDoesntExistsException;
use tiagomichaelsousa\Helm\HelmClient;
use tiagomichaelsousa\Helm\Models\Repository;

afterEach(function () {
    $repositories = HelmClient::repository()->list();
    //$repositories->each(fn ($repository) => HelmClient::repository()->remove($repository));
});

it('allows to add a new repository', function () {
    $repositoryFactory = new Repository('bitnami', 'https://charts.bitnami.com/bitnami');
    $repository = HelmClient::repository()->add($repositoryFactory);

    expect($repository)->toBe($repositoryFactory);
});

it('throws an exception if repository already exists when adding', function () {
    $repositoryFactory = new Repository('bitnami', 'https://charts.bitnami.com/bitnami');
    HelmClient::repository()->add($repositoryFactory);
    HelmClient::repository()->add($repositoryFactory);
})->throws(RepositoryDoesntExistsException::class);

it('allows to find a repository when it exists', function () {
    $repositoryFactory = new Repository('bitnami', 'https://charts.bitnami.com/bitnami');
    HelmClient::repository()->add($repositoryFactory);

    $repository = HelmClient::repository()->find($repositoryFactory);

    $this->assertEquals($repository, $repositoryFactory);
});

it('returns null if could not find the repository', function () {
    $repositoryFactory = new Repository('bitnami', 'https://charts.bitnami.com/bitnami');
    $repository = HelmClient::repository()->find($repositoryFactory);

    expect($repository)->toBeNull();
});

it('throws an exception when trying to remove a repository that dont exist', function () {
    $repository = new Repository('bitnami', 'https://charts.bitnami.com/bitnami');

    HelmClient::repository()->remove($repository);
})->throws(RepositoryDoesntExistsException::class);

it('allows to remove a repository', function () {
    $repository = new Repository('bitnami', 'https://charts.bitnami.com/bitnami');

    HelmClient::repository()->add($repository);
    HelmClient::repository()->remove($repository);
    $repositories = HelmClient::repository()->list();

    expect($repositories)->toHaveCount(0);
});

it('retrieves all repositories', function () {
    $repository = new Repository('bitnami', 'https://charts.bitnami.com/bitnami');

    HelmClient::repository()->add($repository);
    $repositories = HelmClient::repository()->list();

    expect($repositories)->toHaveCount(1);
});

it('should not retrieve repositories when they dont exist', function () {
    $repositories = HelmClient::repository()->list();

    expect($repositories)->toHaveCount(0);
});

/*it('test', function () {
    $repos = HelmClient::repository()->withFlags([
        KubeconfigFlag::class => "/Users/tsousa/Downloads/kubecfg\ \(2\).yaml",
    ])->list();

    dd($repos);
})->only();*/
