<?php

use Illuminate\Support\Facades\File;

beforeEach(function () {
    config()->set('database.connections.testing', [
        'driver' => 'sqlite',
        'database' => ':memory:',
    ]);
    config()->set('filesystems.default', 'ready');
    config()->set('filesystems.disks.ready', [
        'driver' => 'local',
        'root' => storage_path('framework/testing/disks/ready'),
    ]);

    File::ensureDirectoryExists(storage_path('framework/testing/disks/ready'));
});

it('succeeds when the database is reachable', function () {
    $this->artisan('ci:wait', ['--db-connections' => 'testing'])
        ->expectsOutput('Database :memory: is reachable')
        ->assertSuccessful();
});

it('fails after the database timeout expires', function () {
    config()->set('database.connections.unreachable', [
        'driver' => 'unreachable',
    ]);

    $this->artisan('ci:wait', [
        'timeout' => 1,
        '--db-connections' => 'unreachable',
        '--storage-disks' => 'ready',
    ])->assertFailed();
});

it('succeeds when the storage disk is reachable', function () {
    $this->artisan('ci:wait', ['--storage-disks' => 'ready'])
        ->expectsOutput('Storage ready is reachable')
        ->assertSuccessful();
});

it('fails after the storage timeout expires', function () {
    config()->set('filesystems.disks.unreachable', [
        'driver' => 'unreachable',
    ]);

    $this->artisan('ci:wait', [
        'timeout' => 1,
        '--db-connections' => 'testing',
        '--storage-disks' => 'unreachable',
    ])->assertFailed();
});
